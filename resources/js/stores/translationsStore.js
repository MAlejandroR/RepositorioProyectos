import {defineStore} from 'pinia';

export const useTranslationStore
    = defineStore('translations', {
        state: () => ({
                translations: {}
        }),
        actions: {
        updateTranslations(newTranslations) {
            this.translations = newTranslations;
             // console.log("En pinia actions updateTranslatios");
             // console.log(this.translations);
        }
    }
});
