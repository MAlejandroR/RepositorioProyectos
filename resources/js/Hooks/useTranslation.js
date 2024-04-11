import {useTranslationStore} from "@/stores/translationsStore.js";

export function __(text) {
    const translationStore = useTranslationStore()  ;

    return translationStore.translations[text] || text; // Devuelve la clave como fallback

    // console.log("indice " + text);
    // const palabra = datos.translate[text];
    // console.log("PAlabra " + palabra);
    // return palabra;
}
