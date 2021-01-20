
var app = new Vue({
    el: '#vue_app',
    // props: ['bios'],
    template: '#vue_bio_template',
    data: function () {
        return  {
            bio_rows: (JSON.parse(document.getElementById('_bio_rows_4vuejs').value)) || [{date1:null,date2:null,address:'',org:'',reg:false,reg_pushed:false}],
            reg_rows: (JSON.parse(document.getElementById('_reg_rows_4vuejs').value)) || [{date1:null,date2:null,address:'',org:'',reg:false}],

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
        clickTempReg(item){
            if (!item.reg && item.reg_pushed===false)
            {
                this.reg_rows.push(item);
                item.reg_pushed = this.reg_rows.length-1;
            }
            if (item.reg && !item.reg_pushed===false)
            {
                this.$delete(this.reg_rows, item.reg_pushed)
                item.reg_pushed = false;
             }

        },
        addBio(){
            var date1 = null;
            // если есть уже строка,
            // берем ее окончание и делаем началом новой записи
            if (this.bio_rows.length) {
                var date1 = (this.bio_rows[this.bio_rows.length-1].date2);
        }

            this.bio_rows.push({date1:date1,date2:null,address:'',org:'',reg:false,reg_pushed:false})
        },
        addReg(){
            this.reg_rows.push({date1:null,date2:null,address:'',org:'',reg:false})
        },
        delItem(arr,index){
            this.$delete(this.reg_rows, index)
        }
    }
});

