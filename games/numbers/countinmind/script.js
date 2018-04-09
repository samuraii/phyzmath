function getById(id) {
    return document.getElementById(id);
}

// Логгирование результатов
var data = {
    allAttempts: [0],
    mistakes: [],
    sum: function() {
        return data.allAttempts.reduce(function(a, b) {
            return a + b;
        })
    },
    avg: function() {
        return data.sum() / data.allAttempts.length;
    },
    eff: function() {
        return Math.floor(((data.allAttempts.length * 6 - data.mistakes.length) / data.allAttempts.length) * 100 / 6)
    },
    lvl: function() {
        return parseInt(getById('settings').children[0].value)
    }
}

createTask(data.lvl());

// Функция генерирующая задания
function createTask(lvl) {

    (function showStat(data) {
        getById('totalPlayed').innerText = data.allAttempts.length - 1;
        getById('avgTime').innerText = Math.floor(data.avg());
        getById('mistakes').innerText = data.mistakes.length;
        getById('eff').innerText = data.eff() + '%';
    })(data);

    var num1 = random(lvl),
        num2 = random(lvl),
        correct = num1 + num2,
        operand = ['+', '-']

    // Генератор случайного числа ()
    function random(lvl) {
        var base = 10 ** lvl;
        num = Math.floor(Math.random() * (base + base)) - base;
        if (num === 0) return random(lvl);
        else if (Math.abs(num) < (base / 10)) return random(lvl);
        else return num;
    }

    // Умный генератор любого случайного числа кроме заданного
    function genRndNumber(notThisNumber) {
        var base = 10 ** lvl,
            number = random(lvl);

        if(number === notThisNumber) {
            return genRndNumber(correct)
        } else if (base != 10 && (Math.abs(number) - Math.abs(correct)) > (base / 10)) {
            return genRndNumber(correct)
        } else {
            return number;
        }
    }

    // Фиксируем текущее время
    var d = new Date();

    // Вставлетм текущие значения чисел в пример
    getById('num1').innerText = num1;
    getById('num2').innerText = num2;

    // Хэлпер для добавления уникального номера
    function addUniqe(number) {
        if (added.includes(number)) {
            addUniqe(genRndNumber(correct));
        } else {
            added.push(number);
            getById('answers').children[i].innerText = number;
        }
    }

    // Выбираем случайную позицию правильного ответа
    var randomPosition = Math.floor(Math.random() * 6);

    var added = []; // Запоминаем какие номера уже добавлены.
    for (var i = 0; i < 6; i++) {
        getById('answers').children[i].removeAttribute('style');
        if (i === randomPosition) {
            getById('answers').children[i].innerText = correct;
        } else {
            addUniqe(genRndNumber(correct));
        }
    }

    getById('answers').addEventListener('click', function check() {
        var clickPlace = event.target.innerText;
        if (parseInt(clickPlace) === correct) {
            getById('answers').removeEventListener('click', check);
            getById('timer').innerText = (new Date() - d);
            data.allAttempts.push(new Date() - d);
            createTask(data.lvl());
        } else if ((event.target.children.length === 0) && (parseInt(clickPlace) != correct)) {
            // Если элемент уже нажимали то ничего не делаем
            if (event.target.hasAttribute('style', 'box-shadow: 0 2px 0 #006599; background-color: red;')) {
                return;
            }
            data.mistakes.push(1);
            getById('mistakes').innerText = data.mistakes.length;
            event.target.setAttribute('style', 'box-shadow: 0 2px 0 #006599; background-color: red;');
        }
    });

}
