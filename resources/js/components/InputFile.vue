<template>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" accept="text/csv" v-bind:name="name"
                   v-bind:id="id" @change="onFileChange"/>
            <label class="custom-file-label" v-bind:for="id">
                {{ fileName || label }}
            </label>
        </div>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" v-bind:disabled="!fileName">
                <i class="material-icons">upload</i>
                <span>{{ btnLabel }}</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "InputFile",
    props: ['label', 'id', 'name', 'btnLabel'],
    data: () => ({
        fileName: null,
    }),
    computed: {
        getLabel() {
            return this.fileName || this.label
        }
    },
    methods: {
        onFileChange(ev) {
            this.fileName = ev.target.files[0].name;
            console.log(ev.target.files)
        },
    }
}
</script>

<style scoped>

</style>
