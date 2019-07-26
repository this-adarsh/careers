require(
        [
            'Magento_Ui/js/lib/validation/validator',
            'jquery',
            'mage/translate'
    ], function(validator, $){

            validator.addRule(
                'date-greaterthen-current',
                function (value) {
                    console.log(value);
                    return false;
                }
                ,$.mage.__('Custom Validation message.')
            );
});