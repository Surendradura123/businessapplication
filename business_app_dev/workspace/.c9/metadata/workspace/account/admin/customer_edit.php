{"filter":false,"title":"customer_edit.php","tooltip":"/account/admin/customer_edit.php","undoManager":{"mark":19,"position":19,"stack":[[{"start":{"row":187,"column":19},"end":{"row":187,"column":27},"action":"remove","lines":[" </form>"],"id":14}],[{"start":{"row":165,"column":4},"end":{"row":165,"column":8},"action":"insert","lines":["    "],"id":15}],[{"start":{"row":165,"column":8},"end":{"row":165,"column":12},"action":"insert","lines":["    "],"id":16}],[{"start":{"row":165,"column":12},"end":{"row":165,"column":16},"action":"insert","lines":["    "],"id":17}],[{"start":{"row":165,"column":16},"end":{"row":165,"column":20},"action":"insert","lines":["    "],"id":18}],[{"start":{"row":165,"column":20},"end":{"row":165,"column":24},"action":"insert","lines":["    "],"id":19}],[{"start":{"row":165,"column":24},"end":{"row":165,"column":32},"action":"insert","lines":[" </form>"],"id":20}],[{"start":{"row":184,"column":0},"end":{"row":185,"column":28},"action":"remove","lines":["","                        </p>"],"id":21}],[{"start":{"row":184,"column":0},"end":{"row":185,"column":28},"action":"remove","lines":["","                        </p>"],"id":22}],[{"start":{"row":137,"column":0},"end":{"row":184,"column":0},"action":"remove","lines":["                    <form action='' method='post'>","                        <p>","                            <label for='email'>Customer Email:</label>","                            <input type='text' name='email' id='email' value='$customer_email' readonly='true'><br><small>You cannot change the email address.</small>","                        </p>","                        <p>","                            <label for='customer_id'>Customer ID:</label>","                            <input type='text' name='customer_id' id='customer_id' value='$customer_id' readonly='true'><br><small>You cannot change the customer ID.</small>","                        </p>","                        <p>","                            <label for='first_name'>First Name:</label>","                            <input type='text' name='first_name' id='first_name' value='$first_name' pattern='[a-zA-Z0-9\\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only' required><font color='red'><sup>*</sup></font>","                        </p>","                         <p>","                            <label for='last_name'>Last Name:</label>","                            <input type='text' name='last_name' id='last_name' value='$last_name' pattern='[a-zA-Z0-9\\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only'>","                        </p>","                        <p>","                            <label for='phone_home'>Phone (Home):</label>","                            <input type='text' name='phone_home' id='phone_home' value='$phone_home' pattern='\\d{0,10}' title='Numbers only. 9 or 10 numbers including area code.'>","                        </p>","                        <p>","                            <label for='phone_mobile'>Phone (Mobile):</label>","                            <input type='text' name='phone_mobile' id='phone_mobile' value='$phone_mobile' pattern='\\d{0,10}' title='Numbers only. 10 numbers including prefix.'>","                        </p>","                        <p>","                            <input type='submit' value='Submit'>\");","                        ?>","                         </form>","                            <br><br>","                            <?php // @ref: \"Golden Years\" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->","                                if(!isset($bFieldRequired)){","                                    echo ('');","                                }","                                else if(isset($bFieldRequired) && $bFieldRequired){","                                    echo ('');","                                }","                                else if (isset($successDB) && !$successDB){","                                    echo (\"<font color='red'style='background-color: #FFFF00'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: \".$db->error.\"</font>\");","                                    //header( 'Location: ../../error.html' ) ;","                                }","                                else if (isset($successDB) && $successDB){","                                    echo (\"<font color='#3eb740' style='background-color: #FFFF00'>Thank you. The account details have been changed.</font>\");","","                                }","    }","?>",""],"id":23},{"start":{"row":137,"column":0},"end":{"row":237,"column":13},"action":"insert","lines":["                    <form action='' method='post'>","                    <table>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td>    ","\t\t\t\t\t\t\t\t<label for='email'>Customer Email:</label>","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<input type='text' name='email' id='email' value='$customer_email' readonly='true'><br><small>You cannot change the email address.</small>","\t\t\t\t\t\t\t</td>","                        </tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","\t\t\t\t\t\t\t\t&nbsp;","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<label for='customer_id'>Customer ID:</label>","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<input type='text' name='customer_id' id='customer_id' value='$customer_id' readonly='true'><br><small>You cannot change the customer ID.</small>","\t\t\t\t\t\t\t</td>","                        </tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","\t\t\t\t\t\t\t\t&nbsp;","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td> ","\t\t\t\t\t\t\t\t<label for='first_name'>First Name:</label>","                            </td>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<input type='text' name='first_name' id='first_name' value='$first_name' pattern='[a-zA-Z0-9\\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only' required><font color='red'><sup>*</sup></font>","\t\t\t\t\t\t\t</td>","                        </tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","\t\t\t\t\t\t\t\t&nbsp;","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<label for='last_name'>Last Name:</label>","                            </td>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<input type='text' name='last_name' id='last_name' value='$last_name' pattern='[a-zA-Z0-9\\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only'>","\t\t\t\t\t\t\t</td>","                        </tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","\t\t\t\t\t\t\t\t&nbsp;","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td>                            ","\t\t\t\t\t\t\t\t<label for='phone_home'>Phone (Home):</label>","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t\t<td>","\t\t\t\t\t\t\t\t<input type='text' name='phone_home' id='phone_home' value='$phone_home' pattern='\\d{0,10}' title='Numbers only. 9 or 10 numbers including area code.'>","                         ","                         ","                            <label for='phone_mobile'>Phone (Mobile):</label>","                            <input type='text' name='phone_mobile' id='phone_mobile' value='$phone_mobile' pattern='\\d{0,10}' title='Numbers only. 10 numbers including prefix.'>","                        </td>","                        </tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","\t\t\t\t\t\t\t\t&nbsp;","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","                            <p style='text-align:center'><input type='submit' value='Submit'></p>","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t\t\");","                        ?>","                         </form>","                        <tr>","\t\t\t\t\t\t\t<td colspan='2'>","                            <?php // @ref: \"Golden Years\" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->","                                if(!isset($bFieldRequired)){","                                    echo ('');","                                }","                                else if(isset($bFieldRequired) && $bFieldRequired){","                                    echo ('');","                                }","                                else if (isset($successDB) && !$successDB){","                                    echo (\"<font color='red'style='background-color: #FFFF00'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: \".$db->error.\"</font>\");","                                    //header( 'Location: ../../error.html' ) ;","                                }","                                else if (isset($successDB) && $successDB){","                                    echo (\"<font color='#3eb740' style='background-color: #FFFF00'>Thank you. The account details have been changed.</font>\");","","                                }","    }","?>","\t\t\t\t\t\t\t</td>","                        </tr>","\t\t\t\t\t</table>"]}],[{"start":{"row":197,"column":24},"end":{"row":198,"column":25},"action":"remove","lines":[" ","                         "],"id":24},{"start":{"row":197,"column":24},"end":{"row":205,"column":14},"action":"insert","lines":["</td>","                        </tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td colspan='2'>","\t\t\t\t\t\t\t\t&nbsp;","\t\t\t\t\t\t\t</td>","\t\t\t\t\t\t</tr>","\t\t\t\t\t\t<tr>","\t\t\t\t\t\t\t<td>   "]}],[{"start":{"row":205,"column":11},"end":{"row":205,"column":14},"action":"remove","lines":["   "],"id":25}],[{"start":{"row":197,"column":24},"end":{"row":197,"column":25},"action":"insert","lines":["1"],"id":26}],[{"start":{"row":197,"column":24},"end":{"row":197,"column":25},"action":"remove","lines":["1"],"id":27}],[{"start":{"row":197,"column":24},"end":{"row":197,"column":28},"action":"insert","lines":["    "],"id":28}],[{"start":{"row":206,"column":77},"end":{"row":207,"column":0},"action":"insert","lines":["",""],"id":29},{"start":{"row":207,"column":0},"end":{"row":207,"column":28},"action":"insert","lines":["                            "]}],[{"start":{"row":207,"column":28},"end":{"row":208,"column":11},"action":"insert","lines":["</td>","\t\t\t\t\t\t\t<td>"],"id":30}],[{"start":{"row":210,"column":24},"end":{"row":210,"column":28},"action":"insert","lines":["    "],"id":31}],[{"start":{"row":209,"column":28},"end":{"row":209,"column":32},"action":"insert","lines":["    "],"id":32}],[{"start":{"row":206,"column":28},"end":{"row":206,"column":32},"action":"insert","lines":["    "],"id":33}]]},"ace":{"folds":[],"scrolltop":2459,"scrollleft":0,"selection":{"start":{"row":206,"column":32},"end":{"row":206,"column":32},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":188,"state":"php-qqstring","mode":"ace/mode/php"}},"timestamp":1531576405484,"hash":"39833ad0ea90a1a4421fefc58b78a1c1d48011cb"}