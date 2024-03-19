//this is a hashing algorithm based off of SHA-256

function dec2bin(dec) {
    return (dec >>> 0).toString(2);
}


function rightRotate(amount, word) {
    //take the last [amount] and put it at the front.
    wordlen = word.length;
    lastword = "";
    for (i = wordlen - amount; i < wordlen; i++) {
        lastword += (word[i]);
    }
    lastword += (word.substring(0, wordlen - amount));
    console.log("ROTATING " + word + " BY " + amount + " OUTPUT = " + lastword);
    return lastword;
}






//first we must preprocess the input

function toBinary(str){
    let r = []
    for (let i = 0; i < str.length; i++) {
        r.push(str.charCodeAt(i).toString(2));
    }
    return r.join("");
}


//INPUT PROCESSING
function Encrypt(input) {


    console.log("Attempt! " + input);
    input = toBinary(input);
    input += "1";

    inputLength = input.length;
    inputLenBinary = dec2bin(inputLength);
    lenlenBin = inputLenBinary.length;

    console.log(inputLength);
    for (let a = 0; a < ((512 - inputLength) - lenlenBin); a++) {
        input += "0";
    }
    input += inputLenBinary;


    console.log(input);
    console.log(input.length);

    //hash constants
    h0 = 0x6a09e667;
    h1 = 0xbb67ae85;
    h2 = 0x3c6ef372;
    h3 = 0xa54ff53a;
    h4 = 0x510e527f;
    h5 = 0x9b05688c;
    h6 = 0x1f83d9ab;
    h7 = 0x5be0cd19;

    k = [0x428a2f98, 0x71374491, 0xb5c0fbcf, 0xe9b5dba5, 0x3956c25b, 0x59f111f1, 0x923f82a4, 0xab1c5ed5
        , 0xd807aa98, 0x12835b01, 0x243185be, 0x550c7dc3, 0x72be5d74, 0x80deb1fe, 0x9bdc06a7, 0xc19bf174
        , 0xe49b69c1, 0xefbe4786, 0x0fc19dc6, 0x240ca1cc, 0x2de92c6f, 0x4a7484aa, 0x5cb0a9dc, 0x76f988da
        , 0x983e5152, 0xa831c66d, 0xb00327c8, 0xbf597fc7, 0xc6e00bf3, 0xd5a79147, 0x06ca6351, 0x14292967
        , 0x27b70a85, 0x2e1b2138, 0x4d2c6dfc, 0x53380d13, 0x650a7354, 0x766a0abb, 0x81c2c92e, 0x92722c85
        , 0xa2bfe8a1, 0xa81a664b, 0xc24b8b70, 0xc76c51a3, 0xd192e819, 0xd6990624, 0xf40e3585, 0x106aa070
        , 0x19a4c116, 0x1e376c08, 0x2748774c, 0x34b0bcb5, 0x391c0cb3, 0x4ed8aa4a, 0x5b9cca4f, 0x682e6ff3
        , 0x748f82ee, 0x78a5636f, 0x84c87814, 0x8cc70208, 0x90befffa, 0xa4506ceb, 0xbef9a3f7, 0xc67178f2];

    //constructing the word array
    w = [];
    word = "";
    inputLength = input.length;
    for (let i = 0; i < (inputLength); i += 32) {
        word = "";
        for (let b = 0; b < 32; b++) {
            word += input[b + i];
        }
        w.push(word);
    }
    wLength = w.length;
    for (let c = 0; c < (64 - wLength); c++) {
        w.push("00000000000000000000000000000000");
    }
    console.log(w);

    //setup is done, now the encryption starts

    for (a = 16; a < 64; a++) {
        console.log("[" + a + "] is : " + w[a]);
        s0 = (parseInt(rightRotate(7, w[a - 15]), 2) ^ parseInt(rightRotate(18, w[a - 15]), 2) ^ (parseInt(w[a - 15]), 2) >> 3);
        s1 = (parseInt(rightRotate(17, w[a - 2]), 2) ^ parseInt(rightRotate(19, w[a - 2]), 2) ^ (parseInt(w[a - 2], 2) >> 10));
        w[a] = (parseInt(w[a - 16], 2) + s0 + parseInt(w[a - 7], 2) + s1).toString(2);
        console.log("s0 = " + s0 + " || s1 = " + s1);
        console.log("[" + a + "] is :" + w[a]);
    }
    console.log(w);


    //compression

    a = h0;
    b = h1;
    c = h2;
    d = h3;
    e = h4;
    f = h5;
    g = h6;
    h = h7


    for (c = 0; c < 64; c++) {
        s1 = (e >> 6) ^ (e >> 11) ^ (e >> 25);
        ch = (e & f) ^ ((~e) & g);
        temp1 = h + s1 + ch + k[i] + parseInt(w[i], 2);
        s0 = (parseInt(rightRotate(2, a.toString(2)), 2) ^ parseInt(rightRotate(13, a.toString(2)), 2) ^ parseInt(rightRotate(22, a.toString(2)), 2));
        maj = (a & b) ^ (a & c) ^ (b & c);
        temp2 = s0 + maj;
        h = g;
        g = f;
        e = d + temp1;
        d = c;
        c = b;
        b = a;
        a = temp1 + temp2;
    }

    h0 = h0 + a;
    h1 = h1 + b;
    h2 = h2 + c;
    h3 = h3 + d;
    h4 = h4 + e;
    h5 = h5 + f;
    h6 = h6 + g;
    h7 = h7 + h;

    digest = h0.toString(16) + h1.toString(16) + h2.toString(16) + h3.toString(16) + h4.toString(16) + h5.toString(16) + h6.toString(16) + h7.toString(16);
    console.log(digest);
    return digest;

}