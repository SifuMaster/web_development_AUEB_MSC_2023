document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.btn-sm').forEach(function (button) {
        button.addEventListener('click', function () {
            console.log("TESTSTS");
            var productId = this.getAttribute('data-product-id');


            fetch('save_to_session.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        to_delete_id: productId
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        });
    });
});
