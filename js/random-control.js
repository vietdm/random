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

    const showWinner = (winner) => {
        $el.empty();
        for (const text of winner.split('')) {
            $el.append(`<div class="text">${text}</div>`);
        }
    }

    const run = (timeout = 1) => {
        const winner = datas[RandomControlCommon.randomIndex(datas.length)];
        let index = 0;
        let intervalRandomShow = null;
        let intervalChangeIndex = null;
        const doneCallback = () => {
            clearInterval(intervalRandomShow);
            clearInterval(intervalChangeIndex);
            showWinner(winner);
            Fire.success(winnerMgs.replace('%winner%', winner));
        }
        intervalRandomShow = setInterval(() => {
            let randomText = winner.substr(0, index);
            for (let i = index; i < winner.length; i++) {
                randomText += RandomControlCommon.randomOneCharacter();
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
