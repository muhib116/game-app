import { ref, onMounted } from "vue";

const languages = [
    {
        en: 'Rebus run made',
        no: 'Rebusløp gjort'
    },
    {
        en: 'easy!',
        no: 'enkelt'
    },
    {
        en: 'This is the super simple puzzle app that works',
        no: 'Dette er den super enkle rebusløp-appen som fungerer'
    },
    {
        en: 'without you or the participants needing to download and install',
        no: 'uten at du eller deltagerne trenger å laste ned og installere'
    },
    {
        en: 'without you or the participants needing to download and install',
        no: 'software or provide personal information.'
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


export default function useLanguage() {

    const translate = (text, lan_from) => {
        let lan = languages.find(item => {
            return item[lan_from].toLowerCase() == text.toLowerCase();
        });
        return lan ? lan[selectedLanguage.value] : text;
    };
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