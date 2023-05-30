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
export function slug(text) {
  const separator = '-';
  const op = String(text ? text : '')
    .toLowerCase()
    .replace(/\s+/g, separator)
    .replace(/[^a-z0-9]+/g, separator)
    .replace(/-+/g, separator);

  return op;
}
// export function slug(text){
//     const separator = '-';

//     // Convert the string to lowercase and replace non-word characters with the separator
//     const op = String(text ? text : '')
//         .toLowerCase()
//         .replace(/[^a-z0-9]+/g, separator)
//         .replace(new RegExp(`^${separator}|${separator}$`, 'g'), '');

//     return op;
// }