<div>
    <!-- フォームの送信先とHTTPメソッドを指定 -->
    <form action="{{ $routeUrl }}" method="POST">
        @csrf <!-- CSRFトークンの生成 -->
        @method($method) <!-- HTTPメソッドの指定 (POST, PUTなど) -->

        <!-- 名前入力フィールド -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <!-- 送信失敗時にも入力した値を保持 -->
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded mt-1" value="{{ old('name', $food->name ?? '') }}" required>
        </div>

        <!-- タンパク質の入力フィールド -->
        <div class="mb-4">
            <label for="protein" class="block text-gray-700">Protein (g)</label>
            <input type="number" step="0.01" name="protein" id="protein" class="w-full border-gray-300 rounded mt-1" value="{{ old('protein', $food->protein ?? '') }}" required>
        </div>

        <!-- 炭水化物の入力フィールド -->
        <div class="mb-4">
            <label for="carbs" class="block text-gray-700">Carbohydrates (g)</label>
            <input type="number" step="0.01" name="carbs" id="carbs" class="w-full border-gray-300 rounded mt-1" value="{{ old('carbs', $food->carbs ?? '') }}" required>
        </div>

        <!-- 脂肪の入力フィールド -->
        <div class="mb-4">
            <label for="fat" class="block text-gray-700">Fat (g)</label>
            <input type="number" step="0.01" name="fat" id="fat" class="w-full border-gray-300 rounded mt-1" value="{{ old('fat', $food->fat ?? '') }}" required>
        </div>

        <!-- グラムの入力フィールド -->
        <div class="mb-4">
            <label for="grams" class="block text-gray-700">Grams (g)</label>
            <input type="number" step="0.01" name="grams" id="grams" class="w-full border-gray-300 rounded mt-1" value="{{ old('grams', $food->grams ?? '') }}" required>
        </div>

        <!-- 食品タイプの選択フィールド -->
        <div class="mb-4">
            <label for="food_type_name" class="block text-gray-700">Food Type</label>
            <select name="food_type_name" id="food_type_name" class="w-full border-gray-300 rounded mt-1">
                <!-- 各食品タイプの選択肢 -->
                @foreach ($foodTypes as $foodType)
                    <option value="{{ $foodType->name }}" {{ old('food_type_name', $food->food_type_name ?? '') == $foodType->name ? 'selected' : '' }}>
                        {{ $foodType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 送信ボタン -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">submit</button>
        </div>
    </form>
</div>