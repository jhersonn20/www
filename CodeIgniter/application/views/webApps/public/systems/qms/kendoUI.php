<div>asdas</div>
<div>asdsadasdasdasd</div>adsadsadas<div></div><div></div><div></div><div></div><div></div><div></div>asdsadsa<div></div><div></div><div></div><div></div><div></div>
<div><input id="orders" style="width: 400px" /></div>
<script>
    $(document).ready(function() {
        $("#orders").kendoComboBox({
            template: '<span class="order-id">#= OrderID #</span> #= ShipName #, #= ShipCountry #',
            dataTextField: "ShipName",
            dataValueField: "OrderID",
            virtual: true
            height: 520,
            dataSource: {
                type: "odata",
                transport: {
                    read: "http://demos.telerik.com/kendo-ui/service/Northwind.svc/Orders"
                },
                pageSize: 80,
                serverPaging: true,
                serverFiltering: true
            }
        });
    });
</script>