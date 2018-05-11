<template>
    <div>
        <h2>Notes</h2>
    </div>
</template>

<script>

export default {
    data() {
        return {
            notes: [],
            note: {
                id: '',
                title: '',
                body: ''
            }, 
            note_id: '',
            pagination: {},
            edit: false
        }
    },

    created() {
        this.fetchNotes()
    },

    methods: {
        fetchNotes() {
            fetch('http://localhost:8000/api/notes')
                .then(res => {
                    console.log(res);
                })
        }
    }
}

</script>