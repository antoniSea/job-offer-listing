<template>
    <div class="rating">
      <ul class="list">
        <li :key="star" v-for="star in maxStars" :class="{ 'active': star <= stars }" @click="rate(star)" class="star">
            <svg v-if="star <= stars" aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg v-else aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
    export default {
      props: {
        grade: {
          type: Number,
          required: true
        },
        maxStars: {
          type: Number,
          default: 5
        },
        hasCounter: {
          type: Boolean,
          default: true
        }
      },
      data() {
        return {
          stars: this.grade
        }
      },
      methods: {
        rate(star) {
          if (
            typeof star === 'number' &&
            star <= this.maxStars &&
            star >= 0
          )
            this.stars = this.stars === star ? star - 1 : star

            this.$emit('set-rating', this.stars)
        }
      }
    }
  </script>
  
<style scoped>
    .rating {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        font-size: 22px;
        color: #a7a8a8;
    }
    .list {
        margin: 0 0 5px 0;
        padding: 0;
        list-style-type: none;
    }
    .list:hover .star {
        color: #f3d23e;
    }
    .star {
        display: inline-block;
        cursor: pointer;
    }
    .star:hover ~ .star:not(.active) {
        color: inherit;
    }
    .active {
        color: #f3d23e;
    }
</style>
  