$(document).ready(function () {
    var table = $("#dataTable").DataTable({
        fixedHeader: true,
        language: {
            search: "Buscar por:",
            lengthMenu: "Mostrando _MENU_ registros por paginas",
            zeroRecords: "Sem dados para exibir - desculpe",
            info: "Mostrando _PAGE_ de _PAGES_",
            infoEmpty: "Sem Registros",
            infoFiltered: "(filtrado de _MAX_ registros totais)",
        },
    });

    $("#c-password").on("keyup", function () {
        if ($("#password").val() != $("#c-password").val()) {
            $(".senhas").fadeIn();
            $(".btn-usuario").prop("disabled", true);
            return false;
        } else {
            $(".senhas").fadeOut();
            $(".btn-usuario").prop("disabled", false);
        }
    });

    $("#usuario").on("keyup", function () {
        $.ajax({
            url: www_root + "usuarios/verificaUsuario/",
            type: "GET",
            dataType: "json",
            data: {
                nome: $("#usuario").val(),
            },
            success: function (data) {
                if (data.usuario.length === 0) {
                    $(".usuario").fadeOut();
                    $(".btn-usuario").prop("disabled", false);
                } else {
                    $(".usuario").fadeIn();
                    $(".btn-usuario").prop("disabled", true);
                }
            },
        });
    });

    function atualizaTabela() {
        $.ajax({
            type: "get",
            url: www_root + "/requisicoes/listar",
            success: function (data) {
                var html = "";
                jQuery.each(data.requisicoes, function (index, item) {
                    var collor = item.http == "200" ? "green" : "red";
                    html +=
                        "<tr style='color: " +
                        collor +
                        "'>" +
                        "<td>" +
                        item.url.url +
                        "</td>" +
                        "<td>" +
                        item.data_requisicao
                            .substring(0, 10)
                            .split("-")
                            .reverse()
                            .join("/") +
                        " às " +
                        item.data_requisicao.substring(11, 19) +
                        "</td>" +
                        "<td>" +
                        item.http +
                        "</td>" +
                        "</tr>";
                });
                $(".requisicoesHome > tbody tr").remove();
                $(".requisicoesHome > tbody").append(html);
            },
        });
    }

    atualizaTabela();

    setInterval(function () {
        atualizaTabela();
    }, 10000);
});
