import {useTranslationStore} from "@/stores/translationsStore.js";

export function __(text) {
    const translationStore = useTranslationStore()  ;
     // console.log(`Translate ${text}`);
     // console.log("Texto traducido de"+ text +"es"+translationStore.translations[text]);


    return translationStore.translations[text] || text; // Devuelve la clave como fallback

    // console.log("indice " + text);
    // const palabra = datos.translate[text];
    // console.log("PAlabra " + palabra);
    // return palabra;
}
