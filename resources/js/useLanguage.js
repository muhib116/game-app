import { ref, onMounted } from "vue";

const languages = [
    {
        en: "en",
        no: "non-en",
    },
    {
        en: "Email",
        no: "Epost",
    },
    {
        en: "Password",
        no: "Passord",
    },
    {
        en: "Remember me",
        no: "Husk meg neste gang!",
    },
    {
        en: "Forgot your password?",
        no: "Glemt ditt passord?",
    },
    {
        en: "LOG IN",
        no: "Logg inn",
    },
    {
        en: "Dashboard",
        no: "Hjem",
    },
    {
        en: "Welcome to Gamehost",
        no: "Velkommen til rebusløp.no",
    },
    {
        en: "Create new game",
        no: "Lag nytt rebusløp",
    },
    {
        en: "=? Existing game",
        no: "Se eksisterende rebusløp",
    },
    {
        en: "+? Existing game",
        no: "Se eksisterende rebusløp",
    },
    {
        en: "Files",
        no: "Filer",
    },
    {
        en: "Profile",
        no: "Din profil",
    },
    {
        en: "Logout",
        no: "Logg ut",
    },
    {
        en: "PUBLISHED GAME",
        no: "Antall aktive rebusløp",
    },
    {
        en: "UN PUBLISHED GAME TOTAL",
        no: "Ikke aktiverte rebusløp",
    },
    {
        en: "COMPLETE GAME",
        no: "Ferdige/avsluttede rebusløp",
    },
    {
        en: "Login Page Setup",
        no: "Innloggings side",
    },
    {
        en: "Instruction Setup",
        no: "Rebus instruksjon",
    },
    {
        en: "Task Create",
        no: "Legg til oppgaver",
    },
]


const selectedLanguage = ref('en');

const languageList = ref([
    {
        key: 'en',
        value: 'English'
    },
    {
        key: 'no',
        value: 'Norwegian'
    },
]);

const showLanguageModal = ref(false)

const translate = (text, lan_from='en') => {
    let lan = languages.find(item => {
        return item[lan_from].toLowerCase() == text.toLowerCase();
    });
    return lan ? lan[selectedLanguage.value] : text;
};
export {
    translate
}
export default function useLanguage() {

    const languageChanger = (lan) => {
        localStorage.setItem('language', lan);
        showLanguageModal.value = false;
    }
    onMounted(()=> {
        selectedLanguage.value = localStorage.language ? localStorage.language : selectedLanguage.value;
    });
    return {
        translate,
        selectedLanguage,
        languageList,
        showLanguageModal,
        languageChanger
    };
}