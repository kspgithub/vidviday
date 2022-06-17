<template>
    <div class="share dropdown">
        <div class="icon">
            <div class="dropdown-btn full-size"></div>
        </div>
        <div class="dropdown-toggle">
            <div class="social style-1">
                <span v-if="title">{{ title }}</span>

                {{shareUrl}}
                {{shareTitle}}
                <template v-for="(svg, social) in socials">
                    <a :href="shareUrl" :data-sharer="social" :data-title="shareTitle" :data-url="shareUrl" @click.prevent="share" v-html="svg"></a>
                </template>

            </div>
        </div>
    </div>
</template>

<script>
import {onMounted, ref} from "vue";

export default {
    name: "ShareDropdown",
    props: {
        shareUrl: String,
        title: String,
        shareTitle: {
            type: String,
            default: ''
        },
    },
    setup(pros) {

        const shareUrl = pros.shareUrl || document.location.href;
        const shareTitle = pros.shareTitle || document.head.title;

        const fbRef = ref(null);
        const twRef = ref(null);


        const share = (evt) => {
            Sharer.add(evt);
        }

        const socials = {
            facebook: '<svg width="8" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M7.699.003L5.779 0C3.625 0 2.232 1.546 2.232 3.938v1.815H.301C.136 5.753 0 5.9 0 6.08v2.63c0 .18.135.326.302.326H2.23v6.638c0 .18.135.326.302.326H5.05c.167 0 .302-.146.302-.326V9.036h2.255c.167 0 .302-.146.302-.326l.001-2.63a.34.34 0 00-.088-.231.29.29 0 00-.214-.096H5.352V4.214c0-.74.163-1.115 1.054-1.115h1.292c.167 0 .302-.147.302-.327V.33c0-.18-.135-.326-.301-.327z" fill="#4267B2"/></svg>',
            twitter: '<svg width="14" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.683 1.385a5.15 5.15 0 01-.677.258c.273-.324.482-.705.609-1.122a.243.243 0 00-.074-.257.218.218 0 00-.256-.018 5.19 5.19 0 01-1.575.652A2.951 2.951 0 009.606 0C7.949 0 6.601 1.411 6.601 3.146c0 .137.008.273.024.407C4.57 3.363 2.657 2.306 1.345.62A.221.221 0 001.15.533.225.225 0 00.974.65a3.259 3.259 0 00-.407 1.582c0 .758.258 1.478.715 2.04a2.49 2.49 0 01-.402-.188.217.217 0 00-.222.001.238.238 0 00-.113.2v.042c0 1.132.581 2.15 1.47 2.706a2.48 2.48 0 01-.228-.035.22.22 0 00-.212.075.245.245 0 00-.046.23C1.86 8.377 2.706 9.17 3.731 9.41a5.142 5.142 0 01-3.479.81.226.226 0 00-.239.155.242.242 0 00.09.28A7.842 7.842 0 004.488 12c3.06 0 4.974-1.51 6.04-2.778a9.045 9.045 0 002.09-5.999 6.012 6.012 0 001.345-1.49.245.245 0 00-.015-.284.219.219 0 00-.264-.064z" fill="#179CDE"/></svg>',
            linkedin: '<svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="#0077B5" fill-rule="evenodd" d="M20.45175,20.45025 L16.89225,20.45025 L16.89225,14.88075 C16.89225,13.5525 16.86975,11.844 15.04275,11.844 C13.191,11.844 12.90825,13.2915 12.90825,14.7855 L12.90825,20.45025 L9.3525,20.45025 L9.3525,8.997 L12.765,8.997 L12.765,10.563 L12.81375,10.563 C13.2885,9.66225 14.4495,8.71275 16.18125,8.71275 C19.78575,8.71275 20.45175,11.08425 20.45175,14.169 L20.45175,20.45025 Z M5.33925,7.4325 C4.1955,7.4325 3.27375,6.50775 3.27375,5.36775 C3.27375,4.2285 4.1955,3.30375 5.33925,3.30375 C6.47775,3.30375 7.4025,4.2285 7.4025,5.36775 C7.4025,6.50775 6.47775,7.4325 5.33925,7.4325 L5.33925,7.4325 Z M7.11975,20.45025 L3.5565,20.45025 L3.5565,8.997 L7.11975,8.997 L7.11975,20.45025 Z M23.00025,0 L1.0005,0 C0.44775,0 0,0.44775 0,0.99975 L0,22.9995 C0,23.55225 0.44775,24 1.0005,24 L23.00025,24 C23.55225,24 24,23.55225 24,22.9995 L24,0.99975 C24,0.44775 23.55225,0 23.00025,0 L23.00025,0 Z"/></svg>',
            telegram: '<svg width="50px" height="50px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"><path fill="#0077B5" d="M37.1 13L9.4 24c-.9.3-.8 1.6.1 1.9l7 2.2 2.8 8.8c.2.7 1.1.9 1.6.4l4.1-3.8 7.8 5.7c.6.4 1.4.1 1.6-.6l5.4-23.2c.3-1.7-1.2-3-2.7-2.4zM20.9 29.8L20 35l-2-7.2L37.5 15 20.9 29.8z"/></svg>',
            viber: '<svg xmlns="http://www.w3.org/2000/svg" aria-label="Viber" role="img" viewBox="0 0 512 512" fill="#665ca7"><rect width="512" height="512" rx="15%" fill="#fff"/><path fill="none" stroke="#665ca7" stroke-linecap="round" stroke-width="10" d="M269 186a30 30 0 0 1 31 31m-38-58a64 64 0 0 1 64 67m-73-93a97 97 0 0 1 99 104"/><path d="M288 274q10-13 24-4l36 27q8 10-7 28t-28 15q-53-12-102-60t-61-104q0-20 25-34 13-9 22 5l25 35q6 12-7 22c-39 15 51 112 73 70zM95 232c0 78 14 95 36 118 7 7 32 19 38 19v69c0 4 4 7 8 3l53-63 26 1c144 0 161-56 161-147S400 85 256 85 95 141 95 232zm-30 0c0-126 55-177 191-177s191 51 191 177-55 177-191 177c-10 0-18 0-32-2l-38 43c-7 8-28 11-28-13v-42c-6 0-20-6-39-18-19-13-54-44-54-145z"/></svg>',
        };

        return {
            fbRef,
            shareUrl,
            shareTitle,
            twRef,
            share,
            socials,
        }
    }
}
</script>

<style scoped>

</style>
