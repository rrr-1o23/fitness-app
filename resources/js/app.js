import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('Hello World!');

document.addEventListener("DOMContentLoaded", () => {
    const currentPath = window.location.pathname; // 現在のパス
    const navLinks = document.querySelectorAll('nav a'); // ナビゲーション内のリンクを取得

    navLinks.forEach(link => {
        // 現在のパスとリンクのパスが完全一致している場合のみアクティブにする
        const linkPath = new URL(link.href).pathname; // フルURLからパス部分を取得
        if (linkPath === currentPath) {
            link.classList.add('active'); // 'active' クラスを追加
        } else {
            link.classList.remove('active'); // 他のリンクから 'active' を削除
        }
    });
});