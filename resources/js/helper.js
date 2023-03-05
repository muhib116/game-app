import { useToast } from 'vue-toastification';
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';

export const toast = useToast();

const asideActive = ref(false);
Inertia.on('start', (event) => {
    asideActive.value = false;
})

export function useGlobalSetting() {
    const asideToggle = () => {
        asideActive.value = !asideActive.value;
    }
    const closeAside = () => {
        asideActive.value = false; 
    }
    return {
        asideToggle,
        asideActive,
        closeAside
    }
}