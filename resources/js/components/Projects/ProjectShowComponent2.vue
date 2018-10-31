<template>
    <div>
    	<draggable v-model="list2">
            <transition-group>
                <div v-for="element in list2" :key="element.id">
                    {{element.data}}
                </div>
            </transition-group>
        </draggable>
    </div>
</template>

<script>
	import {eventBus} from '../../app.js';
    import draggable from 'vuedraggable';

	export default {
        props: [
            'list2'
        ],
        data () {
        	return {
        		project: {},
                items2: [
                    {
                        id: 1, data: "Draggable 1",
                    }, {
                        id: 2, data: "Draggable 2",
                    }, {
                        id: 3, data: "Draggable 3"
                    }, {
                        id: 4, data: "Draggable 4"
                    },
                ]
        	}
        },
		created () {

		},
        methods: {
	        
        },
        components: { draggable },
    }
</script>