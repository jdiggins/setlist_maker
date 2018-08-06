/*
    songCache keeps track of songs split in 2 parts (beg and end)
*/
var songCache = new Map();

// call getSongList in main to start all the work, this is the only function you need to call
function getSongList(time) {
    var xhr = new XMLHttpRequest();
    songCache = new Map();
        xhr.open('GET', 'getSongList.php');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var userInfo = JSON.parse(xhr.responseText);
                console.log(userInfo);

                makeSetlist(userInfo, time);
            }
        }
        xhr.send();
}

// to start recursive call
function makeSetlist(songList, time) {
    buildSetList([], songList, time);
}

// recursely build the set list
function buildSetList(setList, songList, time) {

    if(time < 0) {
        displaySetList(setList);
    } else {
        var song = pickRandomSongs(songList);
        //removeSong(song, songList);
        setList.push(song);
        
        buildSetList(setList, songList, time - getTotalTime(song));;
    }
}

// adds time of multiple songs in one group of songs
function getTotalTime(songs) {
    var total = 0;
    for(var i = 0; i < songs.length; i++) {
        total += (parseInt(songs[i].length1) + parseInt(songs[i].length2));
    }
    return total;
}

// returns an array of 1-4 songs
function pickRandomSongs(songList) {
    var rand = Math.floor(Math.random() * (songList.length));
    var song = [];
    var againNum;
    do {
        var tempSong;
        if(song.length > 0) {
            tempSong = getSong(songList, song[song.length-1]);
       
        } else {
            tempSong = songList[rand];
        }
        var songHistory = songCache.get(tempSong.title);
        if(songHistory != null) {
            if(songHistory == "beg") {
                againNum =Math.random() * 11;
                removeSong(tempSong, songList);
            }
        } else {
            if(Math.random() * 100 > 80 && tempSong.splittable !== "0" && song.length < 3) {
                // cache song as beginning 
                songCache.set(tempSong.title, "beg");
                againNum = 10;
            } else {
                againNum = Math.random() * 11;
                removeSong(tempSong, songList);
            }
        }
        
        song.push(tempSong);
    } while (againNum > 8 && song.length < 4);

    return song;
}
// picks a song based on key of last song in same group, tries to resolve down a 5th first
function getSong(songList, lastSong) {
    var newSong = null;
    var lastKey = convertToMajor(lastSong.songKey, lastSong.songQuality);
    var count = 0;
    // pick random song
    while(newSong === null) {
        var rando = Math.floor(Math.random() * 8);
        var nextKey;
        if(rando <= 4) {
            nextKey = getFourth(lastKey);
        }
        else if (rando <= 6) {
            nextKey = getFifth(lastKey);
        } else {
            nextKey = getTritone(lastKey);
        }
        
        var songsNextKey = getSongsInKey(songList, nextKey);

        rando = Math.floor(Math.random() * songsNextKey.length);
        if(rando > 0){
            newSong = songsNextKey[rando];
        }else if(count++ > 15) {
            do {
            newSong = pickRandomSongs(songList);
            }while(newSong.title == lastSong.title && count++ < 30) ;
        }
        if(newSong != null && newSong.title == lastSong.title) {
            newSong = null;
        }

    }
    return newSong;
}
function removeSong(song, songList) {
    var index = songList.indexOf(song);
    if(index > -1) {
        songList.splice(index, 1);
    }
}

function displaySetList(setList) {
    removeOldList();

    for(var i = 0; i < setList.length; i++) {
        var newDiv = document.createElement("div");
        newDiv.id="songlist"

        var newContent = "";
        
        if(setList[i].length > 1) {
            for(var j = 0; j < setList[i].length; j++) {
                newContent += setList[i][j].title;
                if (songCache.get(setList[i][j].title) != null) {
                    if(songCache.get(setList[i][j].title) === "beg") {
                        newContent += "(beg)";
                        songCache.set(setList[i][j].title, "end")
                    } else {
                        newContent += "(end)";
                    }
                }
                if(j !== setList[i].length-1) {
                    newContent += " -> "

                }
            }
        } else {
            if(songCache.get(setList[i][0]) !== null) {
                newContent += setList[i][0].title;  
            } else {
                if(songCache.get(setList[i][0] == "beg")) {
                    newContent += setList[i][0];
                    songCache.remove(setList[i][0]);
                }
            }
        }
        newDiv.appendChild(document.createTextNode(newContent));
       
        document.body.appendChild(newDiv);
    }
}

// if old list exists in DOM this will remove it entirely
function removeOldList() {
    var myNode = document.getElementById("songlist");

    while(myNode !== null) {
        myNode.remove();
        myNode = document.getElementById("songlist");
    }

}

// returns list of all songs in given key
function getSongsInKey(songList, key) {
    var newList = [];
    for(var i = 0; i < songList.length; i++) {
        if(convertToMajor(songList[i].songKey, songList[i].songQuality) === key) {
            newList.push(songList[i]);
        }
    }
    return newList;
}

function convertToMajor(curKey, quality) {
    if(quality == "major") {
        return curKey;
    }
    switch(curKey) {
        case "A":
            return "C";
        case "B":
            return "D";
        case "C":
            return "Eb";
        case "D":
            return "F";
        case "E":
            return "G";
        case "F":
            return "Ab";
        case "G":
            return "Bb";
        case "Bb":
            return "Db";
        case "Eb":
            return "Gb";
        case "Ab":
            return "B";
        case "Gb":
            return "A";
    }
}

function getFourth(curKey) {
    switch(curKey) {
        case "A":
            return "D";
        case "B":
            return "E";
        case "C":
            return "F";
        case "D":
            return "G";
        case "E":
            return "A";
        case "F":
            return "Bb";
        case "G":
            return "C";
        case "Bb":
            return "Eb";
        case "Eb":
            return "Ab";
        case "Ab":
            return "Db";
        case "Gb":
            return "B";
    }
}

function getFifth(curKey) {
    switch(curKey) {
        case "A":
            return "E";
        case "B":
            return "Gb";
        case "C":
            return "G";
        case "D":
            return "A";
        case "E":
            return "B";
        case "F":
            return "C";
        case "G":
            return "D";
        case "Bb":
            return "F";
        case "Eb":
            return "Bb";
        case "Ab":
            return "Eb";
        case "Gb":
            return "Db";
    }
}

function getTritone(curKey) {
    switch(curKey) {
        case "A":
            return "Eb";
        case "B":
            return "F";
        case "C":
            return "Gb";
        case "D":
            return "Ab";
        case "E":
            return "Bb";
        case "F":
            return "B";
        case "G":
            return "Db";
        case "Bb":
            return "E";
        case "Eb":
            return "A";
        case "Ab":
            return "D";
        case "Gb":
            return "C";
    }
}
