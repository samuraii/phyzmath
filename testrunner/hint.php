<button class="accordion hint">Подглядеть подсказку</button>
<div class="panel">
    <div><?php

        echo explode("|", $file[$n + 3 - $correct_hint])[1];

        ?></div>
</div>

<script>
    var acc = document.getElementsByClassName("accordion");
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function () {
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script>
