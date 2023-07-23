document.addEventListener("DOMContentLoaded", () => {
    // Получаем контейнер для отображения картинок
    const dressContainer = document.getElementById("dress-container");

    // Отправляем AJAX-запрос на сервер для получения списка платьев
    fetch("/get_dresses")
        .then(response => response.json())
        .then(data => {
            // Обрабатываем полученные данные и создаем элементы для отображения картинок
            data.forEach(dress => {
                const img = document.createElement("img");
                img.src = `data:image/jpeg;base64,${dress.source}`;
                img.alt = dress.title;
                dressContainer.appendChild(img);
            });
        })
        .catch(error => {
            console.error("Ошибка при получении списка платьев:", error);
        });
});