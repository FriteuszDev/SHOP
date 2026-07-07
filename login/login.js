let log_rej = document.querySelector(".log-rej")
let zarejestruj_sie_hint = document.querySelector(".zarejestruj_sie_hint")
let rejestracja = document.querySelector(".rejestracja")
let logowanie = document.querySelector(".Logowanie")
let h_logowanie = document.querySelector(".h-logowanie")
let h_rejestracja = document.querySelector(".h-rejestracja")
let zaloguj_sie_hint = document.querySelector(".zaloguj_sie_hint")


rejestracja.style.display = "none"
h_rejestracja.style.display = "none"

let stan = "logowanie"
log_rej.addEventListener("click", ()=> {
    if (stan=="logowanie"){
        log_rej.innerHTML = '<p>Masz już konto?</p> <span class="zaloguj_sie_hint">Zaloguj się</span>'
        logowanie.style.display = "none"
        h_logowanie.style.display = "none"

        rejestracja.style.display = "block"
        h_rejestracja.style.display = "flex"
        stan = "rejestracja"
    } else if (stan=="rejestracja"){
        log_rej.innerHTML = '<p>Masz już konto?</p> <span class="zarejestruj_sie_hint">Zarejestruj się</span>'
        rejestracja.style.display = "none"
        h_rejestracja.style.display = "none"

        logowanie.style.display = "block"
        h_logowanie.style.display = "flex"
        stan = "logowanie"
    }

})