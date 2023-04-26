<template>
    <div class="form-select" @blur="open = false">
        <div class="selected" @click="open = !open">
            <div class="image" v-if="selected.image">
                <img :src="selected.image" alt="">
            </div>
            <div class="name">{{ selected.name }}</div>
        </div>
        <div class="options-list" v-if="open">
            <div class="options">
                <div class="option" v-for="option in options" :key="option.id" @click="selectOption(option)">
                    <div class="image" v-if="option.image">
                        <img :src="option.image" alt="">
                    </div>
                    <div class="name">{{ option.name }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'FormSelect',
    props: {
        options: {
            type: Array,
            required: true,
        },
        default: {
            type: Object,
            required: false,
            default: null,
        },
    },
    data() {
        return {
            selected: this.default ? this.default : this.options[0] ?? null,
            open: false
        }
    },
    mounted() {
        this.$emit('select', this.selected);
    },
    methods: {
        selectOption(option) {
            this.selected = option;
            this.$emit('select', this.selected);
            this.open = false;
        }
    }
}

</script>

<style>


</style>