document.addEventListener("DOMContentLoaded", () => {
    const app: HTMLElement | null = document.getElementById('calories-calculator');
    if (!app) return;

    app.innerHTML = `
        <div class="calculator">
            <h1>Calorie Calculator</h1>
            <div class="input-group">
                <label for="carbs">Carbs (g):</label>
                <input type="number" id="carbs" class="input" placeholder="Enter carbs">
            </div>
            <div class="input-group">
                <label for="fats">Fats (g):</label>
                <input type="number" id="fats" class="input" placeholder="Enter fats">
            </div>
            <div class="input-group">
                <label for="protein">Protein (g):</label>
                <input type="number" id="protein" class="input" placeholder="Enter protein">
            </div>
            <button id="calculate" class="btn">Calculate</button>
            <div id="result" class="result"></div>
        </div>
    `;

    const calculateButton: HTMLButtonElement | null = document.getElementById('calculate') as HTMLButtonElement;
    const carbsInput: HTMLInputElement | null = document.getElementById('carbs') as HTMLInputElement;
    const fatsInput: HTMLInputElement | null = document.getElementById('fats') as HTMLInputElement;
    const proteinInput: HTMLInputElement | null = document.getElementById('protein') as HTMLInputElement;
    const resultDiv: HTMLElement | null = document.getElementById('result');

    if (calculateButton && carbsInput && fatsInput && proteinInput && resultDiv) {
        calculateButton.addEventListener('click', () => {
            const carbs: number = parseFloat(carbsInput.value) || 0;
            const fats: number = parseFloat(fatsInput.value) || 0;
            const protein: number = parseFloat(proteinInput.value) || 0;

            const totalCalories: number = (carbs * 4) + (fats * 9) + (protein * 4);
            resultDiv.textContent = `Total Calories: ${totalCalories}`;
        });
    }
});