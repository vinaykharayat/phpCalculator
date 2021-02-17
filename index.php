<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
        <script
        src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    </head>
    <body>

        <section id="calculator_container">
            <div id="calculator_screen">
                <h1 id="result"></h1>
            </div>
            <form method="post" action="index.php" id="calculator">
                <div id="calculator_buttons">
                    <div><input type="submit" name="num" value="1"></div>
                    <div><input type="submit" name="num" value="2"></div>
                    <div><input type="submit" name="num" value="3"></div>
                    <div><input type="submit" name="opr" value="+"></div>
                    <div><input type="submit" name="num" value="4"></div>
                    <div><input type="submit" name="num" value="5"></div>
                    <div><input type="submit" name="num" value="6"></div>
                    <div><input type="submit" name="opr" value="-"></div>
                    <div><input type="submit" name="num" value="7"></div>
                    <div><input type="submit" name="num" value="8"></div>
                    <div><input type="submit" name="num" value="9"></div>
                    <div><input type="submit" name="opr" value="*"></div>
                    <div><input type="submit" name="dot" value="."></div>
                    <div><input type="submit" name="num" value="0"></div>
                    <div><input type="submit" name="opr" value="/"></div>
                    <div><input type="submit" name="equal" value="="></div>
                </div>
            </form>

        </section>
        <button id="clear">Clear</button>
        <script>
            let firstNum = "";
            let opr = "";
            let secondNum = "";
            let oprClickedOnce = false;
            $('#clear').on("click", function (e) {
                firstNum = "";
                opr = "";
                secondNum = "";
                oprClickedOnce = false;
                document.querySelector("#result").textContent = "";
            });
            $('#calculator').submit((e) => {
                e.preventDefault();
                if (e["originalEvent"]["submitter"]["name"] == "num" && !oprClickedOnce) {
                    /* *********************************************
                     * Displays first number on screen
                     * *********************************************
                     * Also checks if user click on operator button
                     * *********************************************/
                    firstNum += e["originalEvent"]["submitter"]["value"];
                    document.querySelector("#result").textContent = "";
                    display(firstNum);


                } else if (e["originalEvent"]["submitter"]["name"] == "num" && oprClickedOnce) {
                    /* **********************************************************
                     * Displays second number on screen after operator is pressed
                     * **********************************************************/
                    secondNum += e["originalEvent"]["submitter"]["value"];
                    let printNum = e["originalEvent"]["submitter"]["value"];
                    display(printNum);
//                    


                } else if (e["originalEvent"]["submitter"]["name"] == "opr" && !oprClickedOnce) {
                    /* *************************************************************
                     *  When user entered first number and click on Operation button
                     * *************************************************************/
                    opr = e["originalEvent"]["submitter"]["value"];
                    display(opr);
                    oprClickedOnce = true;

                } else if (e["originalEvent"]["submitter"]["name"] == "opr" && oprClickedOnce) {
                    calculate().then((resolve) => {
                        firstNum = resolve;
                        opr = e["originalEvent"]["submitter"]["value"];
                        secondNum = "";
                        clearScreen();
                        display(firstNum);
                        display(opr);

                    });

                } else if (e["originalEvent"]["submitter"]["name"] == "dot" && opr == "") {
                    firstNum += e["originalEvent"]["submitter"]["value"];
                    document.querySelector("#result").textContent = "";

                    display(firstNum);
                } else if (e["originalEvent"]["submitter"]["name"] == "dot" && !oprClickedOnce) {
                    firstNum += e["originalEvent"]["submitter"]["value"];
                    document.querySelector("#result").textContent = "";

                    display(firstNum);
                } else if (e["originalEvent"]["submitter"]["name"] == "dot" && oprClickedOnce) {
                    secondNum += e["originalEvent"]["submitter"]["value"];

                    display(secondNum);
                } else if (e["originalEvent"]["submitter"]["name"] == "equal" && opr != "") {
                    calculate().then((resolve) => {
                        firstNum = resolve;
                        secondNum = "";
                        clearScreen();
                        display(firstNum);
                        opr = e["originalEvent"]["submitter"]["value"];
                        oprClickedOnce = false;
                    });

                }

                function clearScreen() {
                    document.querySelector("#result").textContent = "";
                }
                
                function display(value) {
                    document.querySelector("#result").textContent += value;


                }

                function calculate() {
                    return new Promise((resolve) => {
                        $.ajax({
                            method: "POST",
                            url: "calculate.php",
                            data: {
                                'firstNum': firstNum,
                                "opr": opr,
                                "secondNum": secondNum
                            },
                            success: (result) => {
                                resolve(result);

                            }
                        });
                    });

                }

            });

        </script>
    </body>
</html>

