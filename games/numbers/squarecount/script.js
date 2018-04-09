var app = document.getElementById('app');

var fieldset = document.createElement('FIELDSET');
fieldset.setAttribute('style', 'margin-left: auto; margin-right: auto;');

var title = document.createElement('DIV');
title.innerText = "Выберите уровень сложности";

var levels = [
    [4, "Уровень 1"],
    [6, "Уровень 2"],
    [8, "Уровень 3"],
    [9, "Уровень 4"]
];

var radio_toolbar = document.createElement('DIV');
radio_toolbar.setAttribute('class', 'radio-toolbar');

for (var i = 0; i < levels.length; i++) {

    var level = document.createElement('INPUT');
    var label = document.createElement('LABEL');
    level.setAttribute('class', 'option');
    level.setAttribute('type', 'radio');
    level.setAttribute('name', 'level');
    level.setAttribute('id', i);
    level.setAttribute('value', levels[i][0]);
    label.setAttribute('for', i);
    label.innerText = levels[i][1];
    radio_toolbar.appendChild(level);
    radio_toolbar.appendChild(label);

}

fieldset.appendChild(title);
fieldset.appendChild(radio_toolbar);
app.appendChild(fieldset);

fieldset.addEventListener('click', function (e) {
    if (e.target.value) gameStarter(e.target.value);
});

var field = document.createElement('TABLE');

function gameStarter(lvl) {
    app.innerHTML = '';
    var math = ["+", "-"];

    for (var i = 0; i < lvl; i++) {
        var tr = document.createElement('TR');

        // раскрашиваем горизонтальную линию
        if (i > 0 && i % 2 === 0) tr.style.backgroundColor = 'lightblue';
        
        for (var j = 0; j < lvl; j++) {
            var td = document.createElement('TD');
            
            //  раскрашиваем вертикаль
            if (j > 0 && j % 2 === 0) td.style.backgroundColor = 'lightgreen';

            
            if (i === 0 && j === 0) td.innerText = "*";
            else if (i === 0) {
                td.innerText = Math.floor(Math.random() * 200) + 50;
            } else if (j === 0) {
                td.innerText = Math.floor(Math.random() * 200) + 50;
            } else {
                var input = document.createElement('INPUT');
                input.setAttribute('maxlength', '4');
                input.value = math[Math.floor(Math.random() * 2)];
                td.appendChild(input);
            }

            tr.appendChild(td);
        }

        field.appendChild(tr);
    }

   app.appendChild(field);
}

field.addEventListener('click', function(e) {
    var operation = e.target.value;

    e.target.addEventListener('input', function(e) {
        console.log(e.target.value);
    });

    e.target.addEventListener('focusout', function(e) {
        console.log('focused out');
    });

});