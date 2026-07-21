const produkty_kontener = document.querySelector('.product-container');

const produkty = produkty_kontener.querySelectorAll(':scope > div');


produkty.forEach((produkt) => {
    produkt.addEventListener("click", (event) => {
        event.preventDefault();
        let klasa = produkt.className; 

        const formData = new FormData();
        formData.append('produkt_do_usuniecia', klasa);

        fetch('koszyk.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Odpowiedź serwera:", data);
            if (data.includes("SUKCES")) {
                produkt.remove(); 
            }
        })
        .catch(error => console.error("Błąd sieci:", error));
    });
});