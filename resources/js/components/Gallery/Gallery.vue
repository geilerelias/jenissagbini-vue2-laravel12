<template>
    <section class="gallery-container" ref="stage">
        <div class="gallery-box">
            <!--图片组件 -->
            <template v-for="(position, index) in positions">

                <image-figure ref="imageFigure"
                              :index="index"
                              :data="pictureDatas[index]"
                              :position="position"
                              @center="center"
                              @inverse="inverse"
                />

            </template>
        </div>
        <nav class="gallery-controller">
            <v-row>
                <v-col class="mt-2">
                    <v-btn icon @click="center(index=0)">
                        <v-icon>
                            mdi-arrow-collapse-left
                        </v-icon>
                    </v-btn>

                    <v-btn icon @click="previus()">
                        <v-icon>
                            mdi-chevron-left
                        </v-icon>
                    </v-btn>

                    <v-btn icon class="primary" :class="{inverse:inverso==true}"  @click="inverse(index)">
                        <v-icon class="white--text">
                            mdi-orbit-variant
                        </v-icon>
                    </v-btn>

                    <v-btn icon @click="next()">
                        <v-icon>
                            mdi-chevron-right
                        </v-icon>
                    </v-btn>

                    <v-btn icon @click="center(index=positions.length-1)">
                        <v-icon>
                            mdi-arrow-collapse-right
                        </v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </nav>
    </section>
</template>

<script>
import ImageFigure from "./ImageFigure.vue"

// let pictureDatas = [];
// (function createPictures(pictureDatas) {
// //获取图片src
//     data.forEach(value => {
//         value.src = `/src/gallery/null/${value.name}`;
//         pictureDatas.push(value);
//     });
// })(pictureDatas);

/**
 * 随机获取两个数中的随机数
 */
function randomPosition(start, end) {
    return Math.floor(Math.random() * (end - start)) + start;
}

/**
 * 随机获取旋转角度
 */
function randomRotate(deg) {
    let randomDeg = Math.ceil(Math.random() * deg);
    return (Math.floor(Math.random() * 2) === 0 ? "-" : "") + randomDeg;
}

export default {
    name: "gallery",
    props: ['pictureDatas'],
    data: function () {
        return {
            inverso: false,
            index: 0,
            positions: []
        }
    },
    components: {
        ImageFigure,
    },
    methods: {
        initPosition,
        allocationPosition,
        /**
         * 翻转对应索引图片
         */
        inverse(index) {
            this.inverso = !this.inverso;
            this.index = index;
            let position = this.positions[index];
            position.inverse = !position.inverse;
            this.positions.splice(index, 1, position);
        },
        /**
         * 居中对应位置的图片
         */
        center(index) {
            this.index = index;
            this.allocationPosition(index);
        },
        previus() {
            if (0 <= this.index - 1)
                this.index = this.index - 1;
            this.center(this.index)
        },
        next() {
            if (this.positions.length > this.index + 1)
                this.index = this.index + 1;
            this.center(this.index)
        }
    },
    created: function () {
        //定义各个位置常量
        this.position = {
            centerPosition: {  //中心点的位置
                left: 0,
                top: 0,
            },
            horizontalPosition: {  //水平方向的位置
                left: [0, 0],  //左半部分
                right: [0, 0],  //右半部分
                center: [0, 0]  //中间部分
            },
            verticalPosition: {  //垂直方向的位置
                y: [0, 0],  //左边和右边区域
                center: [0, 0]  //中间区域
            }
        }

        this.pictureDatas.forEach((value, index) => {
            this.positions[index] = {
                left: 0,
                top: 0,
                rotate: 0,
                center: false,
                inverse: false
            };
        });
    },
    mounted: function () {
        this.initPosition();
        this.allocationPosition(0);
    }
}

//初始化位置
function initPosition() {
    let stageDOM = this.$refs.stage,
        stageW = stageDOM.offsetWidth,
        stageH = stageDOM.offsetHeight;

    //获取第一个ImageFigure组件的根元素
    let imageFigureDOM = this.$refs.imageFigure[0].$el,
        imageFigureW = imageFigureDOM.offsetWidth,
        imageFigureH = imageFigureDOM.offsetHeight;

    //计算左侧、右侧、中心点位置的取值范围
    this.position.centerPosition.left = (stageW - imageFigureW) / 2;
    this.position.centerPosition.top = (stageH - imageFigureH) / 2;

    this.position.horizontalPosition.left[0] = -imageFigureW / 2;
    this.position.horizontalPosition.left[1] = stageW / 2 - imageFigureW / 2 * 3;
    this.position.horizontalPosition.right[0] = stageW / 2 + imageFigureW;
    this.position.horizontalPosition.right[1] = stageW - imageFigureW / 2;
    this.position.verticalPosition.y[0] = -imageFigureH / 2;
    this.position.verticalPosition.y[1] = stageH - imageFigureH;

    //计算顶部区域位置的取值范围
    this.position.horizontalPosition.center[0] = stageW / 2 - imageFigureW;
    this.position.horizontalPosition.center[1] = stageW / 2;
    this.position.verticalPosition.center[0] = -imageFigureH / 2;
    this.position.verticalPosition.center[1] = stageH / 2 - imageFigureH / 2 * 3;
}

function allocationPosition(index) {
    let centerPosition = this.position.centerPosition,
        horizontalPosition = this.position.horizontalPosition,
        verticalPosition = this.position.verticalPosition;

    let positions = this.positions;

    //剔除中心图片的位置信息
    let centerImageFigures = positions.splice(index, 1);

    //设置中心图片的位置
    centerImageFigures[0] = {
        left: centerPosition.left,
        top: centerPosition.top,
        rotate: 0,
        center: true,
        inverse: false
    }

    let topIndex = 0, topSize = Math.floor(Math.random() * 2), //随机获取0或1
        topImageFigures = [];
    if (topSize > 0) {
        //随机获取已剔除中心图片后的索引
        topIndex = Math.floor(Math.random() * positions.length - 1);
        topImageFigures = positions.splice(topIndex, 1);
        //设置顶部图片的位置
        topImageFigures[0] = {
            left: randomPosition(
                horizontalPosition.center[0],
                horizontalPosition.center[1]),
            top: randomPosition(
                verticalPosition.center[0],
                verticalPosition.center[1]),
            rotate: randomRotate(30),
            center: false,
            inverse: false
        }
    }

    //设置两边区域图片的位置
    for (let i = 0, len = positions.length, f = Math.floor(len / 2); i < len; i++) {
        let p = {};
        if (i < f) {
            p.left = randomPosition(
                horizontalPosition.left[0],
                horizontalPosition.left[1]
            );
        } else {
            p.left = randomPosition(
                horizontalPosition.right[0],
                horizontalPosition.right[1]
            );
        }
        p.top = randomPosition(verticalPosition.y[0], verticalPosition.y[1]);
        p.rotate = randomRotate(30);
        p.center = false;
        p.inverse = false;

        positions[i] = p;
    }

    //插入顶部区域图片位置，可能不存在
    topImageFigures.forEach(v => {
        positions.splice(topIndex, 0, v);
    });

    //插入中心图片位置，注意要后于顶部区域图片位置插入
    positions.splice(index, 0, centerImageFigures[0]);
}
</script>

<style scoped>
.gallery-container {
    position: relative;
    width: 100%;
    height: 90vh;
    background: #EEEEEE;
}

.gallery-box {
    position: relative;
    height: 100%;
    overflow: hidden;
    -webkit-perspective: 1000px;
    perspective: 1000px;
}

.gallery-controller {
    position: absolute;
    z-index: 3;
    bottom: 30px;
    width: 100%;
    text-align: center;
}

.inverse {
    -webkit-transform: rotateY(180deg);
    transform: rotateY(180deg);
    -webkit-transition: transform .6s ease-in-out,
    left .6s ease-in-out, top .6s ease-in-out;
    transition: transform .6s ease-in-out,
    left .6s ease-in-out, top .6s ease-in-out;
}
</style>
