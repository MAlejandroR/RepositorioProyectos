import { defineStore } from 'pinia';

export const useTitleStore
    = defineStore('title', {
    state: () => ({
        title: ""
    }),
    actions: {
        updateTitle(newTitle) {
            this.title = newTitle;
            console.log("En pinia actions updateTitle");
            // console.log(this.translations);
        }
    }
});
