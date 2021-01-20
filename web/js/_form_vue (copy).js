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

var app = new Vue({
    el: '#vue_app',
    // props: ['bios'],
    template: '#vue_bio_template',
    data: function () {
        return  {
            _data_from_db:[],
            bio_rows: (JSON.parse(document.getElementById('_bio_rows_4vuejs').value)) || [{data1:null,data2:null,address:'',org:'',reg:false}],
            city: '',
            coordinates: {
                latitude: '',
                longitude: ''
            },
            optAddress: {
                // @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=207454318
                token: 'ed5933cf7d6feed31bba9363ea70c7f5ac1f7717',
                type: "ADDRESS",
                scrollOnFocus: false,
                triggerSelectOnBlur: true,
                triggerSelectOnEnter: true,
                addon: 'none',
                // @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=207454320
                onSelect (suggestion) {
console.log(suggestion)
                }
            },
            optOrg: {
                // @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=207454318
                token: 'ed5933cf7d6feed31bba9363ea70c7f5ac1f7717',
                type: "PARTY",
                scrollOnFocus: false,
                triggerSelectOnBlur: true,
                triggerSelectOnEnter: true,
                addon: 'none',
                // @see https://confluence.hflabs.ru/pages/viewpage.action?pageId=207454320
                onSelect (suggestion) {


                }
            },
        }

    },
    methods:  {
        addRecord(){
            this.bio_rows.push({data1:null,data2:null,address:'',org:'',reg:false})
        }
    }
});

