document.addEventListener("DOMContentLoaded", function () {
    if (window.location.href.indexOf("index.php") !== -1) {
        //        console.log("Script is running on this page:", window.location.href);

        const subcategoryLinks = document.querySelectorAll("a[data-subcategory-id]");
        const warningMessage = document.getElementById("warning-message");

        subcategoryLinks.forEach((link) => {
            link.addEventListener("click", function (event) {
                //            console.log("Subcategory link clicked.");

                // Check if at least one supermarket is selected
                const selectedSupermarkets = document.querySelectorAll("input[name='supermarkets[]']:checked");
                if (selectedSupermarkets.length === 0) {
                    event.preventDefault(); // Prevent redirection

                    alert("Παρακαλώ επιλέξτε τουλάχιστον ένα Σούπερ Μάρκετ για να συνεχίσετε.");
                } else {

                    const subcategoryId = this.getAttribute("data-subcategory-id");
                    const selectedSupermarketIDs = getCheckedSupermarkets();


                    fetch('save_to_session.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                selectedSupermarketIDs,
                                subcategoryId
                            }),
                        })
                        .then(response => response.json())
                        .then(result => {
                            console.log(result);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    }
});



function getCheckedSupermarkets() {
    const checkboxes = document.querySelectorAll(".supermarket-checkbox");
    const checkedSupermarkets = [];

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            checkedSupermarkets.push(checkbox.value);
        }
    });

    return checkedSupermarkets;
};
