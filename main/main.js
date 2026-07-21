const produkty_kontener = document.querySelector('.product-container');

const produkty = produkty_kontener.querySelectorAll(':scope > div');


produkty.forEach((produkt, i) => {
    produkt.addEventListener("click", ()=> {
        event.preventDefault();
        let klasa = produkt.className
        const formData = new FormData();
        formData.append('produkt_do_koszyka', klasa);

        fetch('main.php', {
            method: 'POST',
            body: formData
        });

    })
})