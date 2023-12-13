grapesjs.plugins.add('test-plugin', function(editor) {

    var domComps = editor.DomComponents;
    var dType = domComps.getType('select');
    var dModel = dType.model;
    var dView = dType.view;
    var inputTypes = [
        { value: 'btn btn-primary', name: 'Primary' },
        { value: 'btn btn-info', name: 'Info' },
        { value: 'btn btn-danger', name: 'Danger' },
        { value: 'btn btn btn-warning', name: 'Warning' },
    ];

    domComps.addType('link', {

        model: dModel.extend({

            defaults: Object.assign({}, dModel.prototype.defaults, {
                traits: ['title', 'href', 'target', 'class', {
                    type: 'select',
                    label: 'Button Colors',
                    name: 'classProp',
                    options: inputTypes,
                    changeProp: 1,

                }],
            }),
            init() {
                this.listenTo(this, 'change:classProp', this.doStuff);
            },
            doStuff() {
                console.log(this);
                this.set('classProp', this.changed['classProp']);
                this.view.el.classList.remove();
                this.view.el.className = this.changed['classProp'];
                //this.attributes.tagName = this.get('classProp')
                //this.view.render();
                //editor.trigger('component:update');
                editor.store();
            },
        }, {
            isComponent: function(el) {
                if (el.tagName == 'A') {
                    return { type: 'link' };
                }
            },


        }),
        view: dView.extend({
            render: function() {
                console.log(this);
                //this.model.set('classProp', this.model.get('classProp'));
                editor.render();
                dView.prototype.render.apply(this, arguments);
                // Extend the original render method
                this.el.className = this.model.get('classProp');

                return this;
            },
        }),
        view: dView,
    });

});