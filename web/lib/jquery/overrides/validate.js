jQuery.extend(jQuery.validator.messages, {
    required: "Este campo deve ser preenchido",
    remote: "Please fix this field.",
    email: "Digite um email válido.",
    url: "Digite uma url válida.",
    date: "Digite uma data válida.",
    dateISO: "Digite uma data no formato adequado (ISO).",
    number: "Digite um número válido",
    digits: "Digite apenas dígitos",
    creditcard: "Digite um número de cartão de crédito válido",
    equalTo: "Valores devem ser iguais",
    accept: "Digite um valor com a extensão válida",
    maxlength: jQuery.validator.format("Digite no máximo {0} caracteres."),
    minlength: jQuery.validator.format("Digite pelo menos {0} caracteres."),
    rangelength: jQuery.validator.format("Digite entre {0} e {1} caracteres."),
    range: jQuery.validator.format("Digite um valor entre {0} e {1}."),
    max: jQuery.validator.format("Digite um valor menor ou igual a {0}."),
    min: jQuery.validator.format("Digite um valor maior ou igual a {0}.")
});