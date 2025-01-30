// FoodSearchクラスのインターフェース。検索フォームのID、結果を表示するコンテナのID、検索URL、CSRFトークン、
// ページネーションリンクを指定するためのセレクタを含むオプション。
interface FoodSearchOptions {
    formId: string;              // 検索フォームのID
    resultsContainerId: string;  // 検索結果を表示するコンテナのID
    searchUrl: string;           // 検索結果を取得するためのURL
    csrfToken: string;           // CSRFトークン。セキュリティ対策で必須
    paginationLinksSelector: string;  // ページネーションリンクを選択するためのセレクタ
}

// FoodSearchクラス。検索フォームの内容が変更されるとサーバにリクエストを送り、
// 結果をリアルタイムに更新する機能を提供する。
class FoodSearch {
    private options: FoodSearchOptions;  // クラスのオプションを格納する変数
    private form: HTMLFormElement;       // 検索フォームの要素を格納
    private resultsContainer: HTMLElement; // 検索結果を表示するコンテナ要素
    private searchUrl: string;           // サーバにリクエストを送るURL
    private csrfToken: string;           // セキュリティトークン
    private paginationLinksSelector: string; // ページネーションリンクのセレクタ

    // コンストラクタ。クラスのオプションを初期化し、初期化処理を呼び出す。
    constructor(options: FoodSearchOptions) {
        this.options = options;
        this.form = document.getElementById(options.formId) as HTMLFormElement;  // フォーム要素を取得
        this.resultsContainer = document.getElementById(options.resultsContainerId) as HTMLElement;  // 検索結果表示コンテナを取得
        this.searchUrl = options.searchUrl;  // 検索結果取得用のURL
        this.csrfToken = options.csrfToken;  // CSRFトークン
        this.paginationLinksSelector = options.paginationLinksSelector;  // ページネーションリンクのセレクタ

        this.init();  // 初期化処理を呼び出し
    }

    // init関数は、フォームの入力が変更されたときにリアルタイム検索を行うためのイベントリスナーを設定する。
    private init() {
        if (this.form) {
            // フォームの入力が変更されたときにupdateUrl関数とfetchResults関数を呼び出す
            this.form.addEventListener('input', () => {
                this.updateUrl();  // URLを更新
                this.fetchResults();  // サーバにリクエストを送信し、結果を取得
            });
        } else {
            // フォームが見つからない場合のエラーハンドリング
            console.error(`Form element with id "${this.options.formId}" not found`);
        }
    }

    // updateUrl関数は、ユーザーの入力に基づいて現在のページのURLクエリパラメータを更新する。
    private updateUrl() {
        const formData = new FormData(this.form);  // フォームのデータを取得
        const searchParams = new URLSearchParams(window.location.search);  // 現在のURLのクエリパラメータを取得

        // フォームデータをURLパラメータにセット
        for (const [key, value] of formData.entries()) {
            searchParams.set(key, value.toString());
        }

        // 新しいURLを生成し、履歴を更新
        const newUrl = `${window.location.pathname}?${searchParams.toString()}`;
        history.pushState(null, '', newUrl);
    }

    // fetchResults関数は、フォームデータをサーバに送信し、検索結果を取得する。
    // 非同期処理を行い、サーバからのレスポンスを待って結果を表示する。
    private async fetchResults(url: string = this.searchUrl): Promise<void> {
        const formData = new FormData(this.form);  // フォームデータを取得
        const searchParams = new URLSearchParams(formData as any);  // URLパラメータに変換

        // POSTリクエストをサーバに送信
        const response = await fetch(url, {
            method: 'POST',  // HTTPメソッドはPOST
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',  // URLエンコードされたデータを送信
                'X-CSRF-TOKEN': this.csrfToken,  // CSRFトークンを送信
            },
            body: searchParams.toString()  // リクエストボディに検索パラメータを設定
        });

        // レスポンスが正常か確認
        if (response.ok) {
            const results = await response.json();  // レスポンスをJSONとして解析
            console.log(results);
            if (!results.empty){
                this.resultsContainer.innerHTML = results.content;  // 結果をHTMLに挿入
                this.updatePaginationLinks();  // ページネーションリンクを更新
            }
        }
    }

    // updatePaginationLinks関数は、ページネーションリンクに検索パラメータを追加し、リンクを更新する。
    private updatePaginationLinks() {
        const formData = new FormData(this.form);  // フォームデータを取得
        const searchParams = new URLSearchParams(formData as any);  // URLパラメータに変換

        // ページネーションリンクを取得し、検索パラメータを追加してリンクを更新
        // const paginationLinks = this.resultsContainer.querySelectorAll('a[href*="page="]');
        const paginationLinks = this.resultsContainer.querySelectorAll<HTMLAnchorElement>(this.paginationLinksSelector);
        paginationLinks.forEach((link: HTMLAnchorElement) => {
            const url = new URL(link.href);  // リンクのURLを解析
            searchParams.forEach((value, key) => {
                url.searchParams.set(key, value);  // URLに検索パラメータを追加
            });
            link.href = url.toString();  // リンクのURLを更新
        });
    }
}

export default FoodSearch;