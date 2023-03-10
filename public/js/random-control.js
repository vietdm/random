const RandomControlCommon = {
    randomOneNumber() {
        const characters = '0123456789';
        const charactersLength = characters.length;
        return characters.charAt(Math.floor(Math.random() * charactersLength));
    },
    randomOneCharacter() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        return characters.charAt(Math.floor(Math.random() * charactersLength));
    },
    makePhone() {
        let result = '0';
        for (let index = 0; index < 9; index++) {
            result += this.randomOneNumber();
        }
        return result;
    },
    generateStr(length) {
        let result = '0';
        for (let index = 0; index < length; index++) {
            result += this.randomOneCharacter();
        }
        return result;
    },
    randomIndex(length) {
        return Math.floor(Math.random() * length);
    }
}

function RandomControl(datas, el, winnerMgs = '%winner% đã chiến thắng!!!') {
    const $el = $(el);
    let dataRandom = [];

    if (datas instanceof Promise) {
        datas.then(data => dataRandom = data);
    } else {
        dataRandom = datas;
    }

    const showWinner = (winner) => {
        $el.empty();
        for (const text of winner.split('')) {
            $el.append(`<div class="text">${text}</div>`);
        }
    }

    const run = async (timeout = 1) => {
        if ($('#start-random').prop('disabled') || $('#start-random').hasClass('disabled')) {
            return;
        }
        const listWinner = await Winner.all();
        $('#start-random').prop('disabled', true);
        const dataCurrent = dataRandom.filter(data => !listWinner.includes(data));
        const winner = dataCurrent[RandomControlCommon.randomIndex(dataCurrent.length)];
        if (!winner) {
            return;
        }
        listWinner.push(winner);
        Winner.add(winner);
        $('.random-text').hide(100);
        $('.random-show').show(100);
        await new Promise(resolve => setTimeout(resolve, 200));
        $('.random-show').css('display', 'flex');
        let index = 0;
        let intervalRandomShow = null;
        let intervalChangeIndex = null;
        const doneCallback = () => {
            clearInterval(intervalRandomShow);
            clearInterval(intervalChangeIndex);
            showWinner(winner);
            Winner.render();
            Fire.success(winnerMgs.replace('%winner%', winner));
            if (listWinner.length !== dataRandom.length) $('#start-random').prop('disabled', false);
        }
        intervalRandomShow = setInterval(() => {
            let randomText = winner.substr(0, index);
            for (let i = index; i < winner.length; i++) {
                randomText += RandomControlCommon.randomOneNumber();
            }
            showWinner(randomText);
        }, 50);
        intervalChangeIndex = setInterval(() => {
            ++index;
            if (index === winner.length) {
                doneCallback();
            }
        }, timeout * 1000);
    }

    return { run }
}
