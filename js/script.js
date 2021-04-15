$('#search').keyup(function ()
{
    if ($('#search').val() !== "")
    {
        $.ajax({
            url: 'moto.php',
            type: 'GET',
            dataType: 'JSON',
            data: 'search=' + $(this).val()
        }).done(function (data)
        {
            var str = ""
            for (var i = 0; i < data.length; i++)
            {
                str = str + '<a style="cursor:pointer;">' + data[i][0]['modele'] + '</a><br />'
            }

            document.getElementById('matchList').innerHTML = str
        })
    }

    $('#matchList').on('click', 'a', function (e)
    {
        e.preventDefault();
        console.log($(this).text());
        document.getElementById('search').value = $(this).text();
    })
})
