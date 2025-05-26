<template>
    <div class="lb" v-if="items.length>0">
        <div class="lb-grid" :class="[css,items.length>cells?'lb-grid-' + cells: 'lb-grid-' + items.length]">
            <div class="lb-item" v-for="(src, i) in items" @click="show(i)" v-if="i<cells" :style="bg(src)">
                <span class="lb-more" v-if="i==cells-1 && items.length - cells>0">{{ items.length - cells}}+</span>
            </div>
        </div>

        <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
            <div class="lb-modal" v-if="index>=0">
                <v-btn
                    @click="close"
                    icon
                    large
                    color="error"
                    class="lb-modal-close"
                >
                    <v-icon>mdi-close-circle</v-icon>
                </v-btn>

                <v-btn
                    @click="prev"
                    icon
                    large
                    color="info"
                    class="lb-modal-prev"
                >
                    <v-icon>mdi-chevron-left</v-icon>
                </v-btn>


                <v-btn
                    @click="next"
                    icon
                    large
                    color="info"
                    class="lb-modal-next"
                >
                    <v-icon>mdi-chevron-right</v-icon>
                </v-btn>

                <div class="lb-modal-img d-flex justify-center align-center" @click="close">
                    <v-img contain :src="src" class="mx-auto"
                           style="position: absolute; height: 100vh !important;width: 100vw !important;"/>

                    <div class="spinner spinner-dots-wave" v-if="loading">
                        <span class="badge badge-primary rounded-circle w-10 h-10">
                            <i class="sr-only">&nbsp;</i>
                        </span>
                        <span class="badge badge-primary rounded-circle w-10 h-10">
                            <i class="sr-only">&nbsp;</i>
                        </span>
                        <span class="badge badge-primary rounded-circle w-10 h-10">
                            <i class="sr-only">&nbsp;</i>
                        </span>
                        <span class="badge badge-primary rounded-circle w-10 h-10">
                            <i class="sr-only">&nbsp;</i>
                        </span>
                        <span class="badge badge-primary rounded-circle w-10 h-10">
                            <i class="sr-only">&nbsp;</i>
                        </span>
                    </div>
                </div>

            </div>
        </transition>
    </div>
</template>

<script>

export default {
    props: {
        items: {
            type: Array,
            default: () => {
                return []
            }
        },
        css: {
            type: String,
            default: () => 'h-250 h-md-400 h-lg-600'
        },
        cells: {
            type: Number,
            default: () => 5
        }
    },

    data() {
        return {
            src: '',
            index: -1,
            loading: false,
            events: []
        }
    },

    methods: {
        bind() {

            if (this.events.length > 0) return;

            this.events.push(['keydown', e => {
                if (this.index < 0) return;
                if (e.keyCode === 37) {
                    this.prev();
                } else if (e.keyCode === 39) {
                    this.next();
                } else if (e.keyCode === 27) {
                    this.close();
                }
            }]);
            this.events.forEach(e => {
                window.addEventListener(e[0], e[1]);
            });
        },

        show(i) {
            if (i >= this.items.length) {
                i = 0;
            }
            if (i < 0) {
                i = this.items.length - 1;
            }
            this.loading = true;
            this.bind();
            this.index = i;
            var src = this.items[i];
            var img = new Image();
            img.src = src;
            img.onload = () => {
                this.loading = false;
                this.src = src;
            }
        },
        next() {
            this.show(this.index - 1);
        },

        prev() {
            this.show(this.index + 1);
        },
        close() {
            this.index = -1;
            this.events.forEach(e => {
                window.removeEventListener(e[0], e[1]);
            });
            this.events = [];
        },
        bg(i) {
            return i && i.length > 0 ? `background-image: url('${i}')` : '';
        }

    },


}
</script>

<style>
.lb-grid {
    position: relative;
    display: block
}

.lb-item {
    position: absolute;
    background-position: 50%;
    background-repeat: no-repeat;
    background-size: cover;
    border-top: 2px solid #fff;
    border-right: 2px solid #fff;
    cursor: pointer
}

.lb-grid-1 .lb-item {
    width: 100%;
    height: 100%
}

.lb-grid-2 .lb-item,
.lb-grid-3 .lb-item,
.lb-grid-4 .lb-item,
.lb-grid-5 .lb-item {
    width: 50%
}

.lb-grid-2 .lb-item,
.lb-grid-3 .lb-item:first-child,
.lb-grid-4 .lb-item:first-child {
    height: 100%
}

.lb-grid-3 .lb-item:nth-child(2),
.lb-grid-3 .lb-item:nth-child(3),
.lb-grid-5 .lb-item:first-child,
.lb-grid-5 .lb-item:nth-child(2) {
    height: 50%
}

.lb-grid-2 .lb-item:nth-child(2),
.lb-grid-3 .lb-item:nth-child(2),
.lb-grid-3 .lb-item:nth-child(3),
.lb-grid-4 .lb-item:nth-child(2),
.lb-grid-4 .lb-item:nth-child(3),
.lb-grid-4 .lb-item:nth-child(4),
.lb-grid-5 .lb-item:nth-child(3),
.lb-grid-5 .lb-item:nth-child(4),
.lb-grid-5 .lb-item:nth-child(5),
.lb-item:last-child {
    left: auto;
    right: 0;
    border-right: 0
}

.lb-grid-3 .lb-item:nth-child(3),
.lb-grid-4 .lb-item:nth-child(4),
.lb-grid-5 .lb-item:nth-child(2),
.lb-grid-5 .lb-item:nth-child(5) {
    bottom: 0;
    top: auto
}

.lb-grid-4 .lb-item:nth-child(3),
.lb-grid-5 .lb-item:nth-child(4) {
    top: 33.333333333333336%
}

.lb-grid-4 .lb-item:nth-child(2),
.lb-grid-4 .lb-item:nth-child(3),
.lb-grid-4 .lb-item:nth-child(4),
.lb-grid-5 .lb-item:nth-child(3),
.lb-grid-5 .lb-item:nth-child(4),
.lb-grid-5 .lb-item:nth-child(5) {
    height: 33.333333333333336%
}

.lb-more {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    text-align: center;
    color: #fff;
    font-size: 3rem;
    background-color: rgba(0, 0, 0, 0.4)
}

.lb-more:before {
    display: inline-block;
    content: "";
    vertical-align: middle;
    height: 100%
}

.lb-modal {
    transition: opacity .2s ease;
    position: fixed;
    z-index: 99999;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    min-height: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.8);
    display: block;
    -webkit-user-select: none;
    -moz-user-select: -moz-none;
    -o-user-select: none;
    -ms-user-select: none;
    user-select: none
}

.lb-modal-close {
    position: absolute;
    right: 20px;
    top: 20px;
    color: #fff
}

.lb-modal-next,
.lb-modal-prev {
    position: absolute;
    top: 50%;
    left: 20px;
    margin-top: -25px;
    z-index: 999;
    cursor: pointer;
    color: #fff;
    background-color: transparent;
    border: none
}

.lb-modal-next {
    left: auto;
    right: 20px
}

.lb-modal-img {
    position: absolute;
    top: 10px;
    left: 70px;
    right: 70px;
    bottom: 10px;
    text-align: center
}

.lb-modal-img:before {
    display: inline-block;
    content: "";
    vertical-align: middle;
    height: 100%
}

.lb-modal-img img {
    max-width: 100%;
    max-height: 100%;
    vertical-align: middle;
    -o-object-fit: contain;
    object-fit: contain
}

.lb-modal-img .spinner {
    width: 150px;
    position: absolute;
    margin-left: -75px;
    top: 50%;
    left: 50%;
    z-index: 1
}


/*______________________________*/

/*/*-----------*//*-----------*//*-----------*//*-----------*//*-----------*//*-----------*/
/*/*-----------*//*-----------*//*-----------*//*-----------*//*-----------*//*-----------*/
/*/*-----------*//*-----------*//*-----------*//*-----------*//*-----------*//*-----------*/
.w-3 {
    width: .189rem !important
}

.w-5 {
    width: .315rem !important
}

.w-10 {
    width: .63rem !important
}

.w-15 {
    width: .945rem !important
}

.w-20 {
    width: 1.26rem !important
}

.w-25 {
    width: 1.575rem !important
}

.w-30 {
    width: 1.89rem !important
}

.w-35 {
    width: 2.205rem !important
}

.w-40 {
    width: 2.52rem !important
}

.w-50 {
    width: 3.15rem !important
}

.w-60 {
    width: 3.78rem !important
}

.w-70 {
    width: 4.41rem !important
}

.w-80 {
    width: 5.04rem !important
}

.w-90 {
    width: 5.67rem !important
}

.w-100 {
    width: 6.3rem !important
}

.w-150 {
    width: 9.45rem !important
}

.w-200 {
    width: 12.6rem !important
}

.w-250 {
    width: 15.75rem !important
}

.w-300 {
    width: 18.9rem !important
}

.w-350 {
    width: 22.05rem !important
}

.w-400 {
    width: 25.2rem !important
}

.w-450 {
    width: 28.35rem !important
}

.w-500 {
    width: 31.5rem !important
}

.w-550 {
    width: 34.65rem !important
}

.w-600 {
    width: 37.8rem !important
}

.w-650 {
    width: 40.95rem !important
}

.w-p5 {
    width: 5% !important
}

.w-p10 {
    width: 10% !important
}

.w-p15 {
    width: 15% !important
}

.w-p20 {
    width: 20% !important
}

.w-p25 {
    width: 25% !important
}

.w-p30 {
    width: 30% !important
}

.w-p33 {
    width: 33.3333% !important
}

.w-p40 {
    width: 40% !important
}

.w-p50 {
    width: 50% !important
}

.w-p60 {
    width: 60% !important
}

.w-p70 {
    width: 70% !important
}

.w-p75 {
    width: 75% !important
}

.w-p80 {
    width: 80% !important
}

.w-p100 {
    width: 100% !important
}

.w-full {
    width: 100% !important
}

.h-3 {
    height: .189rem !important
}

.h-5 {
    height: .315rem !important
}

.h-10 {
    height: .63rem !important
}

.h-15 {
    height: .945rem !important
}

.h-20 {
    height: 1.26rem !important
}

.h-25 {
    height: 1.575rem !important
}

.h-30 {
    height: 1.89rem !important
}

.h-35 {
    height: 2.205rem !important
}

.h-40 {
    height: 2.52rem !important
}

.h-50 {
    height: 3.15rem !important
}

.h-60 {
    height: 3.78rem !important
}

.h-70 {
    height: 4.41rem !important
}

.h-80 {
    height: 5.04rem !important
}

.h-90 {
    height: 5.67rem !important
}

.h-100 {
    height: 6.3rem !important
}

.h-150 {
    height: 9.45rem !important
}

.h-200 {
    height: 12.6rem !important
}

.h-250 {
    height: 15.75rem !important
}

.h-300 {
    height: 18.9rem !important
}

.h-350 {
    height: 22.05rem !important
}

.h-400 {
    height: 25.2rem !important
}

.h-450 {
    height: 28.35rem !important
}

.h-500 {
    height: 31.5rem !important
}

.h-550 {
    height: 34.65rem !important
}

.h-600 {
    height: 37.8rem !important
}

.h-650 {
    height: 40.95rem !important
}

.h-p5 {
    height: 5% !important
}

.h-p10 {
    height: 10% !important
}

.h-p15 {
    height: 15% !important
}

.h-p20 {
    height: 20% !important
}

.h-p25 {
    height: 25% !important
}

.h-p30 {
    height: 30% !important
}

.h-p33 {
    height: 33.3333% !important
}

.h-p40 {
    height: 40% !important
}

.h-p50 {
    height: 50% !important
}

.h-p60 {
    height: 60% !important
}

.h-p70 {
    height: 70% !important
}

.h-p75 {
    height: 75% !important
}

.h-p80 {
    height: 80% !important
}

.h-p100 {
    height: 100% !important
}

.h-full {
    height: 100% !important
}

@media (min-width: 480px) {
    .w-sm-3 {
        width: .189rem !important
    }

    .w-sm-5 {
        width: .315rem !important
    }

    .w-sm-10 {
        width: .63rem !important
    }

    .w-sm-15 {
        width: .945rem !important
    }

    .w-sm-20 {
        width: 1.26rem !important
    }

    .w-sm-25 {
        width: 1.575rem !important
    }

    .w-sm-30 {
        width: 1.89rem !important
    }

    .w-sm-35 {
        width: 2.205rem !important
    }

    .w-sm-40 {
        width: 2.52rem !important
    }

    .w-sm-50 {
        width: 3.15rem !important
    }

    .w-sm-60 {
        width: 3.78rem !important
    }

    .w-sm-70 {
        width: 4.41rem !important
    }

    .w-sm-80 {
        width: 5.04rem !important
    }

    .w-sm-90 {
        width: 5.67rem !important
    }

    .w-sm-100 {
        width: 6.3rem !important
    }

    .w-sm-150 {
        width: 9.45rem !important
    }

    .w-sm-200 {
        width: 12.6rem !important
    }

    .w-sm-250 {
        width: 15.75rem !important
    }

    .w-sm-300 {
        width: 18.9rem !important
    }

    .w-sm-350 {
        width: 22.05rem !important
    }

    .w-sm-400 {
        width: 25.2rem !important
    }

    .w-sm-450 {
        width: 28.35rem !important
    }

    .w-sm-500 {
        width: 31.5rem !important
    }

    .w-sm-550 {
        width: 34.65rem !important
    }

    .w-sm-600 {
        width: 37.8rem !important
    }

    .w-sm-650 {
        width: 40.95rem !important
    }

    .w-sm-p5 {
        width: 5% !important
    }

    .w-sm-p10 {
        width: 10% !important
    }

    .w-sm-p15 {
        width: 15% !important
    }

    .w-sm-p20 {
        width: 20% !important
    }

    .w-sm-p25 {
        width: 25% !important
    }

    .w-sm-p30 {
        width: 30% !important
    }

    .w-sm-p33 {
        width: 33.3333% !important
    }

    .w-sm-p40 {
        width: 40% !important
    }

    .w-sm-p50 {
        width: 50% !important
    }

    .w-sm-p60 {
        width: 60% !important
    }

    .w-sm-p70 {
        width: 70% !important
    }

    .w-sm-p75 {
        width: 75% !important
    }

    .w-sm-p80 {
        width: 80% !important
    }

    .w-sm-p100 {
        width: 100% !important
    }

    .w-sm-full {
        width: 100% !important
    }

    .h-sm-3 {
        height: .189rem !important
    }

    .h-sm-5 {
        height: .315rem !important
    }

    .h-sm-10 {
        height: .63rem !important
    }

    .h-sm-15 {
        height: .945rem !important
    }

    .h-sm-20 {
        height: 1.26rem !important
    }

    .h-sm-25 {
        height: 1.575rem !important
    }

    .h-sm-30 {
        height: 1.89rem !important
    }

    .h-sm-35 {
        height: 2.205rem !important
    }

    .h-sm-40 {
        height: 2.52rem !important
    }

    .h-sm-50 {
        height: 3.15rem !important
    }

    .h-sm-60 {
        height: 3.78rem !important
    }

    .h-sm-70 {
        height: 4.41rem !important
    }

    .h-sm-80 {
        height: 5.04rem !important
    }

    .h-sm-90 {
        height: 5.67rem !important
    }

    .h-sm-100 {
        height: 6.3rem !important
    }

    .h-sm-150 {
        height: 9.45rem !important
    }

    .h-sm-200 {
        height: 12.6rem !important
    }

    .h-sm-250 {
        height: 15.75rem !important
    }

    .h-sm-300 {
        height: 18.9rem !important
    }

    .h-sm-350 {
        height: 22.05rem !important
    }

    .h-sm-400 {
        height: 25.2rem !important
    }

    .h-sm-450 {
        height: 28.35rem !important
    }

    .h-sm-500 {
        height: 31.5rem !important
    }

    .h-sm-550 {
        height: 34.65rem !important
    }

    .h-sm-600 {
        height: 37.8rem !important
    }

    .h-sm-650 {
        height: 40.95rem !important
    }

    .h-sm-p5 {
        height: 5% !important
    }

    .h-sm-p10 {
        height: 10% !important
    }

    .h-sm-p15 {
        height: 15% !important
    }

    .h-sm-p20 {
        height: 20% !important
    }

    .h-sm-p25 {
        height: 25% !important
    }

    .h-sm-p30 {
        height: 30% !important
    }

    .h-sm-p33 {
        height: 33.3333% !important
    }

    .h-sm-p40 {
        height: 40% !important
    }

    .h-sm-p50 {
        height: 50% !important
    }

    .h-sm-p60 {
        height: 60% !important
    }

    .h-sm-p70 {
        height: 70% !important
    }

    .h-sm-p75 {
        height: 75% !important
    }

    .h-sm-p80 {
        height: 80% !important
    }

    .h-sm-p100 {
        height: 100% !important
    }

    .h-sm-full {
        height: 100% !important
    }
}

@media (min-width: 768px) {
    .w-md-3 {
        width: .189rem !important
    }

    .w-md-5 {
        width: .315rem !important
    }

    .w-md-10 {
        width: .63rem !important
    }

    .w-md-15 {
        width: .945rem !important
    }

    .w-md-20 {
        width: 1.26rem !important
    }

    .w-md-25 {
        width: 1.575rem !important
    }

    .w-md-30 {
        width: 1.89rem !important
    }

    .w-md-35 {
        width: 2.205rem !important
    }

    .w-md-40 {
        width: 2.52rem !important
    }

    .w-md-50 {
        width: 3.15rem !important
    }

    .w-md-60 {
        width: 3.78rem !important
    }

    .w-md-70 {
        width: 4.41rem !important
    }

    .w-md-80 {
        width: 5.04rem !important
    }

    .w-md-90 {
        width: 5.67rem !important
    }

    .w-md-100 {
        width: 6.3rem !important
    }

    .w-md-150 {
        width: 9.45rem !important
    }

    .w-md-200 {
        width: 12.6rem !important
    }

    .w-md-250 {
        width: 15.75rem !important
    }

    .w-md-300 {
        width: 18.9rem !important
    }

    .w-md-350 {
        width: 22.05rem !important
    }

    .w-md-400 {
        width: 25.2rem !important
    }

    .w-md-450 {
        width: 28.35rem !important
    }

    .w-md-500 {
        width: 31.5rem !important
    }

    .w-md-550 {
        width: 34.65rem !important
    }

    .w-md-600 {
        width: 37.8rem !important
    }

    .w-md-650 {
        width: 40.95rem !important
    }

    .w-md-p5 {
        width: 5% !important
    }

    .w-md-p10 {
        width: 10% !important
    }

    .w-md-p15 {
        width: 15% !important
    }

    .w-md-p20 {
        width: 20% !important
    }

    .w-md-p25 {
        width: 25% !important
    }

    .w-md-p30 {
        width: 30% !important
    }

    .w-md-p33 {
        width: 33.3333% !important
    }

    .w-md-p40 {
        width: 40% !important
    }

    .w-md-p50 {
        width: 50% !important
    }

    .w-md-p60 {
        width: 60% !important
    }

    .w-md-p70 {
        width: 70% !important
    }

    .w-md-p75 {
        width: 75% !important
    }

    .w-md-p80 {
        width: 80% !important
    }

    .w-md-p100 {
        width: 100% !important
    }

    .w-md-full {
        width: 100% !important
    }

    .h-md-3 {
        height: .189rem !important
    }

    .h-md-5 {
        height: .315rem !important
    }

    .h-md-10 {
        height: .63rem !important
    }

    .h-md-15 {
        height: .945rem !important
    }

    .h-md-20 {
        height: 1.26rem !important
    }

    .h-md-25 {
        height: 1.575rem !important
    }

    .h-md-30 {
        height: 1.89rem !important
    }

    .h-md-35 {
        height: 2.205rem !important
    }

    .h-md-40 {
        height: 2.52rem !important
    }

    .h-md-50 {
        height: 3.15rem !important
    }

    .h-md-60 {
        height: 3.78rem !important
    }

    .h-md-70 {
        height: 4.41rem !important
    }

    .h-md-80 {
        height: 5.04rem !important
    }

    .h-md-90 {
        height: 5.67rem !important
    }

    .h-md-100 {
        height: 6.3rem !important
    }

    .h-md-150 {
        height: 9.45rem !important
    }

    .h-md-200 {
        height: 12.6rem !important
    }

    .h-md-250 {
        height: 15.75rem !important
    }

    .h-md-300 {
        height: 18.9rem !important
    }

    .h-md-350 {
        height: 22.05rem !important
    }

    .h-md-400 {
        height: 25.2rem !important
    }

    .h-md-450 {
        height: 28.35rem !important
    }

    .h-md-500 {
        height: 31.5rem !important
    }

    .h-md-550 {
        height: 34.65rem !important
    }

    .h-md-600 {
        height: 37.8rem !important
    }

    .h-md-650 {
        height: 40.95rem !important
    }

    .h-md-p5 {
        height: 5% !important
    }

    .h-md-p10 {
        height: 10% !important
    }

    .h-md-p15 {
        height: 15% !important
    }

    .h-md-p20 {
        height: 20% !important
    }

    .h-md-p25 {
        height: 25% !important
    }

    .h-md-p30 {
        height: 30% !important
    }

    .h-md-p33 {
        height: 33.3333% !important
    }

    .h-md-p40 {
        height: 40% !important
    }

    .h-md-p50 {
        height: 50% !important
    }

    .h-md-p60 {
        height: 60% !important
    }

    .h-md-p70 {
        height: 70% !important
    }

    .h-md-p75 {
        height: 75% !important
    }

    .h-md-p80 {
        height: 80% !important
    }

    .h-md-p100 {
        height: 100% !important
    }

    .h-md-full {
        height: 100% !important
    }
}

@media (min-width: 992px) {
    .w-lg-3 {
        width: .189rem !important
    }

    .w-lg-5 {
        width: .315rem !important
    }

    .w-lg-10 {
        width: .63rem !important
    }

    .w-lg-15 {
        width: .945rem !important
    }

    .w-lg-20 {
        width: 1.26rem !important
    }

    .w-lg-25 {
        width: 1.575rem !important
    }

    .w-lg-30 {
        width: 1.89rem !important
    }

    .w-lg-35 {
        width: 2.205rem !important
    }

    .w-lg-40 {
        width: 2.52rem !important
    }

    .w-lg-50 {
        width: 3.15rem !important
    }

    .w-lg-60 {
        width: 3.78rem !important
    }

    .w-lg-70 {
        width: 4.41rem !important
    }

    .w-lg-80 {
        width: 5.04rem !important
    }

    .w-lg-90 {
        width: 5.67rem !important
    }

    .w-lg-100 {
        width: 6.3rem !important
    }

    .w-lg-150 {
        width: 9.45rem !important
    }

    .w-lg-200 {
        width: 12.6rem !important
    }

    .w-lg-250 {
        width: 15.75rem !important
    }

    .w-lg-300 {
        width: 18.9rem !important
    }

    .w-lg-350 {
        width: 22.05rem !important
    }

    .w-lg-400 {
        width: 25.2rem !important
    }

    .w-lg-450 {
        width: 28.35rem !important
    }

    .w-lg-500 {
        width: 31.5rem !important
    }

    .w-lg-550 {
        width: 34.65rem !important
    }

    .w-lg-600 {
        width: 37.8rem !important
    }

    .w-lg-650 {
        width: 40.95rem !important
    }

    .w-lg-p5 {
        width: 5% !important
    }

    .w-lg-p10 {
        width: 10% !important
    }

    .w-lg-p15 {
        width: 15% !important
    }

    .w-lg-p20 {
        width: 20% !important
    }

    .w-lg-p25 {
        width: 25% !important
    }

    .w-lg-p30 {
        width: 30% !important
    }

    .w-lg-p33 {
        width: 33.3333% !important
    }

    .w-lg-p40 {
        width: 40% !important
    }

    .w-lg-p50 {
        width: 50% !important
    }

    .w-lg-p60 {
        width: 60% !important
    }

    .w-lg-p70 {
        width: 70% !important
    }

    .w-lg-p75 {
        width: 75% !important
    }

    .w-lg-p80 {
        width: 80% !important
    }

    .w-lg-p100 {
        width: 100% !important
    }

    .w-lg-full {
        width: 100% !important
    }

    .h-lg-3 {
        height: .189rem !important
    }

    .h-lg-5 {
        height: .315rem !important
    }

    .h-lg-10 {
        height: .63rem !important
    }

    .h-lg-15 {
        height: .945rem !important
    }

    .h-lg-20 {
        height: 1.26rem !important
    }

    .h-lg-25 {
        height: 1.575rem !important
    }

    .h-lg-30 {
        height: 1.89rem !important
    }

    .h-lg-35 {
        height: 2.205rem !important
    }

    .h-lg-40 {
        height: 2.52rem !important
    }

    .h-lg-50 {
        height: 3.15rem !important
    }

    .h-lg-60 {
        height: 3.78rem !important
    }

    .h-lg-70 {
        height: 4.41rem !important
    }

    .h-lg-80 {
        height: 5.04rem !important
    }

    .h-lg-90 {
        height: 5.67rem !important
    }

    .h-lg-100 {
        height: 6.3rem !important
    }

    .h-lg-150 {
        height: 9.45rem !important
    }

    .h-lg-200 {
        height: 12.6rem !important
    }

    .h-lg-250 {
        height: 15.75rem !important
    }

    .h-lg-300 {
        height: 18.9rem !important
    }

    .h-lg-350 {
        height: 22.05rem !important
    }

    .h-lg-400 {
        height: 25.2rem !important
    }

    .h-lg-450 {
        height: 28.35rem !important
    }

    .h-lg-500 {
        height: 31.5rem !important
    }

    .h-lg-550 {
        height: 34.65rem !important
    }

    .h-lg-600 {
        height: 37.8rem !important
    }

    .h-lg-650 {
        height: 40.95rem !important
    }

    .h-lg-p5 {
        height: 5% !important
    }

    .h-lg-p10 {
        height: 10% !important
    }

    .h-lg-p15 {
        height: 15% !important
    }

    .h-lg-p20 {
        height: 20% !important
    }

    .h-lg-p25 {
        height: 25% !important
    }

    .h-lg-p30 {
        height: 30% !important
    }

    .h-lg-p33 {
        height: 33.3333% !important
    }

    .h-lg-p40 {
        height: 40% !important
    }

    .h-lg-p50 {
        height: 50% !important
    }

    .h-lg-p60 {
        height: 60% !important
    }

    .h-lg-p70 {
        height: 70% !important
    }

    .h-lg-p75 {
        height: 75% !important
    }

    .h-lg-p80 {
        height: 80% !important
    }

    .h-lg-p100 {
        height: 100% !important
    }

    .h-lg-full {
        height: 100% !important
    }
}

@media (min-width: 1200px) {
    .w-xl-3 {
        width: .189rem !important
    }

    .w-xl-5 {
        width: .315rem !important
    }

    .w-xl-10 {
        width: .63rem !important
    }

    .w-xl-15 {
        width: .945rem !important
    }

    .w-xl-20 {
        width: 1.26rem !important
    }

    .w-xl-25 {
        width: 1.575rem !important
    }

    .w-xl-30 {
        width: 1.89rem !important
    }

    .w-xl-35 {
        width: 2.205rem !important
    }

    .w-xl-40 {
        width: 2.52rem !important
    }

    .w-xl-50 {
        width: 3.15rem !important
    }

    .w-xl-60 {
        width: 3.78rem !important
    }

    .w-xl-70 {
        width: 4.41rem !important
    }

    .w-xl-80 {
        width: 5.04rem !important
    }

    .w-xl-90 {
        width: 5.67rem !important
    }

    .w-xl-100 {
        width: 6.3rem !important
    }

    .w-xl-150 {
        width: 9.45rem !important
    }

    .w-xl-200 {
        width: 12.6rem !important
    }

    .w-xl-250 {
        width: 15.75rem !important
    }

    .w-xl-300 {
        width: 18.9rem !important
    }

    .w-xl-350 {
        width: 22.05rem !important
    }

    .w-xl-400 {
        width: 25.2rem !important
    }

    .w-xl-450 {
        width: 28.35rem !important
    }

    .w-xl-500 {
        width: 31.5rem !important
    }

    .w-xl-550 {
        width: 34.65rem !important
    }

    .w-xl-600 {
        width: 37.8rem !important
    }

    .w-xl-650 {
        width: 40.95rem !important
    }

    .w-xl-p5 {
        width: 5% !important
    }

    .w-xl-p10 {
        width: 10% !important
    }

    .w-xl-p15 {
        width: 15% !important
    }

    .w-xl-p20 {
        width: 20% !important
    }

    .w-xl-p25 {
        width: 25% !important
    }

    .w-xl-p30 {
        width: 30% !important
    }

    .w-xl-p33 {
        width: 33.3333% !important
    }

    .w-xl-p40 {
        width: 40% !important
    }

    .w-xl-p50 {
        width: 50% !important
    }

    .w-xl-p60 {
        width: 60% !important
    }

    .w-xl-p70 {
        width: 70% !important
    }

    .w-xl-p75 {
        width: 75% !important
    }

    .w-xl-p80 {
        width: 80% !important
    }

    .w-xl-p100 {
        width: 100% !important
    }

    .w-xl-full {
        width: 100% !important
    }

    .h-xl-3 {
        height: .189rem !important
    }

    .h-xl-5 {
        height: .315rem !important
    }

    .h-xl-10 {
        height: .63rem !important
    }

    .h-xl-15 {
        height: .945rem !important
    }

    .h-xl-20 {
        height: 1.26rem !important
    }

    .h-xl-25 {
        height: 1.575rem !important
    }

    .h-xl-30 {
        height: 1.89rem !important
    }

    .h-xl-35 {
        height: 2.205rem !important
    }

    .h-xl-40 {
        height: 2.52rem !important
    }

    .h-xl-50 {
        height: 3.15rem !important
    }

    .h-xl-60 {
        height: 3.78rem !important
    }

    .h-xl-70 {
        height: 4.41rem !important
    }

    .h-xl-80 {
        height: 5.04rem !important
    }

    .h-xl-90 {
        height: 5.67rem !important
    }

    .h-xl-100 {
        height: 6.3rem !important
    }

    .h-xl-150 {
        height: 9.45rem !important
    }

    .h-xl-200 {
        height: 12.6rem !important
    }

    .h-xl-250 {
        height: 15.75rem !important
    }

    .h-xl-300 {
        height: 18.9rem !important
    }

    .h-xl-350 {
        height: 22.05rem !important
    }

    .h-xl-400 {
        height: 25.2rem !important
    }

    .h-xl-450 {
        height: 28.35rem !important
    }

    .h-xl-500 {
        height: 31.5rem !important
    }

    .h-xl-550 {
        height: 34.65rem !important
    }

    .h-xl-600 {
        height: 37.8rem !important
    }

    .h-xl-650 {
        height: 40.95rem !important
    }

    .h-xl-p5 {
        height: 5% !important
    }

    .h-xl-p10 {
        height: 10% !important
    }

    .h-xl-p15 {
        height: 15% !important
    }

    .h-xl-p20 {
        height: 20% !important
    }

    .h-xl-p25 {
        height: 25% !important
    }

    .h-xl-p30 {
        height: 30% !important
    }

    .h-xl-p33 {
        height: 33.3333% !important
    }

    .h-xl-p40 {
        height: 40% !important
    }

    .h-xl-p50 {
        height: 50% !important
    }

    .h-xl-p60 {
        height: 60% !important
    }

    .h-xl-p70 {
        height: 70% !important
    }

    .h-xl-p75 {
        height: 75% !important
    }

    .h-xl-p80 {
        height: 80% !important
    }

    .h-xl-p100 {
        height: 100% !important
    }

    .h-xl-full {
        height: 100% !important
    }
}

@media (min-width: 1600px) {
    .w-xxl-3 {
        width: .189rem !important
    }

    .w-xxl-5 {
        width: .315rem !important
    }

    .w-xxl-10 {
        width: .63rem !important
    }

    .w-xxl-15 {
        width: .945rem !important
    }

    .w-xxl-20 {
        width: 1.26rem !important
    }

    .w-xxl-25 {
        width: 1.575rem !important
    }

    .w-xxl-30 {
        width: 1.89rem !important
    }

    .w-xxl-35 {
        width: 2.205rem !important
    }

    .w-xxl-40 {
        width: 2.52rem !important
    }

    .w-xxl-50 {
        width: 3.15rem !important
    }

    .w-xxl-60 {
        width: 3.78rem !important
    }

    .w-xxl-70 {
        width: 4.41rem !important
    }

    .w-xxl-80 {
        width: 5.04rem !important
    }

    .w-xxl-90 {
        width: 5.67rem !important
    }

    .w-xxl-100 {
        width: 6.3rem !important
    }

    .w-xxl-150 {
        width: 9.45rem !important
    }

    .w-xxl-200 {
        width: 12.6rem !important
    }

    .w-xxl-250 {
        width: 15.75rem !important
    }

    .w-xxl-300 {
        width: 18.9rem !important
    }

    .w-xxl-350 {
        width: 22.05rem !important
    }

    .w-xxl-400 {
        width: 25.2rem !important
    }

    .w-xxl-450 {
        width: 28.35rem !important
    }

    .w-xxl-500 {
        width: 31.5rem !important
    }

    .w-xxl-550 {
        width: 34.65rem !important
    }

    .w-xxl-600 {
        width: 37.8rem !important
    }

    .w-xxl-650 {
        width: 40.95rem !important
    }

    .w-xxl-p5 {
        width: 5% !important
    }

    .w-xxl-p10 {
        width: 10% !important
    }

    .w-xxl-p15 {
        width: 15% !important
    }

    .w-xxl-p20 {
        width: 20% !important
    }

    .w-xxl-p25 {
        width: 25% !important
    }

    .w-xxl-p30 {
        width: 30% !important
    }

    .w-xxl-p33 {
        width: 33.3333% !important
    }

    .w-xxl-p40 {
        width: 40% !important
    }

    .w-xxl-p50 {
        width: 50% !important
    }

    .w-xxl-p60 {
        width: 60% !important
    }

    .w-xxl-p70 {
        width: 70% !important
    }

    .w-xxl-p75 {
        width: 75% !important
    }

    .w-xxl-p80 {
        width: 80% !important
    }

    .w-xxl-p100 {
        width: 100% !important
    }

    .w-xxl-full {
        width: 100% !important
    }

    .h-xxl-3 {
        height: .189rem !important
    }

    .h-xxl-5 {
        height: .315rem !important
    }

    .h-xxl-10 {
        height: .63rem !important
    }

    .h-xxl-15 {
        height: .945rem !important
    }

    .h-xxl-20 {
        height: 1.26rem !important
    }

    .h-xxl-25 {
        height: 1.575rem !important
    }

    .h-xxl-30 {
        height: 1.89rem !important
    }

    .h-xxl-35 {
        height: 2.205rem !important
    }

    .h-xxl-40 {
        height: 2.52rem !important
    }

    .h-xxl-50 {
        height: 3.15rem !important
    }

    .h-xxl-60 {
        height: 3.78rem !important
    }

    .h-xxl-70 {
        height: 4.41rem !important
    }

    .h-xxl-80 {
        height: 5.04rem !important
    }

    .h-xxl-90 {
        height: 5.67rem !important
    }

    .h-xxl-100 {
        height: 6.3rem !important
    }

    .h-xxl-150 {
        height: 9.45rem !important
    }

    .h-xxl-200 {
        height: 12.6rem !important
    }

    .h-xxl-250 {
        height: 15.75rem !important
    }

    .h-xxl-300 {
        height: 18.9rem !important
    }

    .h-xxl-350 {
        height: 22.05rem !important
    }

    .h-xxl-400 {
        height: 25.2rem !important
    }

    .h-xxl-450 {
        height: 28.35rem !important
    }

    .h-xxl-500 {
        height: 31.5rem !important
    }

    .h-xxl-550 {
        height: 34.65rem !important
    }

    .h-xxl-600 {
        height: 37.8rem !important
    }

    .h-xxl-650 {
        height: 40.95rem !important
    }

    .h-xxl-p5 {
        height: 5% !important
    }

    .h-xxl-p10 {
        height: 10% !important
    }

    .h-xxl-p15 {
        height: 15% !important
    }

    .h-xxl-p20 {
        height: 20% !important
    }

    .h-xxl-p25 {
        height: 25% !important
    }

    .h-xxl-p30 {
        height: 30% !important
    }

    .h-xxl-p33 {
        height: 33.3333% !important
    }

    .h-xxl-p40 {
        height: 40% !important
    }

    .h-xxl-p50 {
        height: 50% !important
    }

    .h-xxl-p60 {
        height: 60% !important
    }

    .h-xxl-p70 {
        height: 70% !important
    }

    .h-xxl-p75 {
        height: 75% !important
    }

    .h-xxl-p80 {
        height: 80% !important
    }

    .h-xxl-p100 {
        height: 100% !important
    }

    .h-xxl-full {
        height: 100% !important
    }
}




</style>
