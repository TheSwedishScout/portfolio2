<?php
$file = 'contact';
$title = 'Contact';
include('header.php');
?>
            <main class="whiteborder">
                <p>
                    Do you like my work, feel free to contact me and I'll answer
                    as fast as i can.
                </p>
                <p>
                    Email me at <a href="mailto: max@timje.se">max@timje.se</a>
                </p>
                <form>
                    <label>
                        Name:
                        <input
                            class="whiteborder"
                            type="text"
                            placeholder="Firstname Lastname"
                        />
                    </label>
                    <label>
                        Email:
                        <input
                            class="whiteborder"
                            type="email"
                            placeholder="name@example.com"
                        />
                    </label>
                    <label>
                        Message:
                        <textarea
                            class="whiteborder"
                            placeholder="Your message"
                        ></textarea>
                    </label>
                    <input class="whiteborder" type="submit" value="Send" />
                </form>
            </main>
<?php

include('footer.php');

?>