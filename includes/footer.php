<script>
    const itemElements = document.getElementsByClassName('item');

    if (itemElements) {
        for (let i = 0; i < itemElements.length; i++) {
            const itemId = itemElements[i].id;
            if (itemId) {
                document.getElementById(itemId).addEventListener('click', function (event) {
                    if (!event.target.classList.contains('important-button')) {
                        sessionStorage.setItem('ItemId', itemId);
                        console.log(sessionStorage.getItem('ItemId'));
                        switchPage('item&item=' + itemId);
                    }
                })
            }
        }
    }
</script>
<script src="../js/main.js"></script>
<footer>
    <!-- Your footer content goes here -->
    <p>&copy; 2023 Study project WAT Parve&Fedorova. All rights reserved.</p>
</footer>
<?php includeWarning(); ?>

