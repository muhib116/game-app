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
        console.log(asideActive.value);
        asideActive.value = !asideActive.value;
    }
    return {
        asideToggle,
        asideActive,
    }
}