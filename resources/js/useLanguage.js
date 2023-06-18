import { ref, onMounted } from "vue";
import languages from "./languageData";

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
    if(!text) return text;
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