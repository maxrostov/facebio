Vue.component('dadata', {
    template: `<input type="text" v-model="value">`,
    props: {
        model: {
            required: true
        },
        model_address:'',
        coordinates: {},
        options: {
            type: Object,
            default: {
                type: 'ADDRESS',
                addon: 'none'
            }
        }
    },
    data() {
        return {
            value: '',
            address:'',
            coords: {
                latitude: '',
                longitude: ''
            },
        }
    },
    mounted() {
        this.callbacks = $.Callbacks();
        this.value = this.model;
        this.initSuggestion();
    },
    destroyed() {
        this.destroySuggestion();
    },
    watch: {
        coords: {
            handler() {
                this.$emit('update:coordinates', this.coords);
            },
            deep: true
        },
        value() {
            this.$emit('update:model', this.value);
        },
        address() {
            this.$emit('update:model_address', this.address);
        },
        model() {
            this.value = this.model;
        },
        model_address() {
            this.address = this.model_address;
        }
    },
    methods: {
        initSuggestion() {
            this.callbacks.add(this.onSelect);
            this.callbacks.add(this.options.onSelect || $.noop)
            const options = Object.assign({}, this.options, {
                onSelect: suggestion => this.callbacks.fire(suggestion)
            });
            $(this.$el).suggestions(options);
        },
        destroySuggestion() {
            const plugin = $(this.$el).suggestions();
            plugin.dispose();
        },
        onSelect(suggestion) {
            this.value = suggestion.value;
            // нашли организцаию -- подставляем индекс и адрес автоматом в поле адреса (для потенциальной прописки)
            if(this.options.type=='PARTY'){
                this.address = suggestion.data.address.data.postal_code+
                    ' '+ suggestion.data.address.unrestricted_value;
            }
            const { geo_lat, geo_lon } = suggestion.data;
            this.coords.latitude = geo_lat;
            this.coords.longitude = geo_lon;
        }
    }
});
