# Encrypt Decrypt Web App
> Using Simple Substitution, Double Transposition, RC4
<p>
<a href="https://github.com/stevenmngo"><img alt="Author" src="https://img.shields.io/badge/author-Stevenmngo-red.svg?style=flat-square"/></a>
</p>

------------------------------
## Requirement 
Build a web page that: <br/>
* Ensures a secure Session mechanism.
* Allows the user to sign in and sign up.
* Allows the user to submit a text file (extension .txt ONLY).
* Allows the user to submit text in an input text box.
* Allows the user to select a cipher from a list and if the input should be encrypted or decrypted.

Build a web application that: <br/>
* Reads the file in input and the cipher selected, then applies this cipher (encryption or decryption, based on the user's input).
* Reads the text from the input text box, if any, and the cipher selected, then applies this cipher (encryption or decryption, based on the user's input)
* Implements these ciphers (not use libraries): 
  * Simple Substitution
  * Double Transposition
  * RC4

Build a MySQL database that:
* Stores the input texts from that specific user (if logged in), the cipher used and the timestamp at the moment of the creation of the record.
* Stores the information related to the user accounts: username, password (hash and salt) ,and email
  * All these fields must be validated:
    * The username can contain English letters (capitalized or not), digits, and the characters '_' (underscore) and '-' (dash). Nothing else. At least 5 characters.
    * The email must be well formatted.
    * The password can contain English letters (capitalized or not) and digits. At least 8 characters.

------------------------------
## Cryptography 
* Simple Substitution <br/>
    Each letter in the plaintext is replaced by a letter some fixed number of positions down the alphabet. For example, with a 
    left shift of 3, D would be replaced by A, E would become B, and so on (wikipedia).  
* Double Transposition <br/>
    In a Double transposition, the message is written out in rows of a fixed length, and then read out again column by 
    column, and the columns are chosen in some scrambled order. Both the width of the rows and the permutation of the columns 
    are defined by a keyword (wikipedia). 
* RC4 <br/>
    RC4 generates a pseudorandom stream of bits (a keystream). As with any stream cipher, these can be used for encryption by 
    combining it with the plaintext using bit-wise exclusive-or; decryption is performed the same way (since exclusive-or with 
    given data is an involution) (wikipedia). 
    
------------------------------
## Testing the Web Application   
1. Download XAMPP, free and open-source cross-platform web server solution stack package.
    https://www.apachefriends.org/download.html
2. Download the repository
3. Place the all files inside XAMPP/htdocs folder 
4. Start the XAMPP program.

------------------------------
*  Text Box Input
<img width="680" alt="Screen Shot 2019-05-26 at 10 21 19 PM" src="https://user-images.githubusercontent.com/36215446/58437787-6cbcea00-8080-11e9-9f39-b69b107a55be.png">


* Text File Input 
<img width="681" alt="Screen Shot 2019-05-26 at 10 22 08 PM" src="https://user-images.githubusercontent.com/36215446/58437754-3e3f0f00-8080-11e9-85ce-429693ff4b04.png">

* Sign In 
<img width="682" alt="Screen Shot 2019-05-26 at 10 22 38 PM" src="https://user-images.githubusercontent.com/36215446/58437841-af7ec200-8080-11e9-9022-e22ffcee5245.png">

* Sign Up
<img width="679" alt="Screen Shot 2019-05-26 at 10 23 02 PM" src="https://user-images.githubusercontent.com/36215446/58437875-ca513680-8080-11e9-89eb-f0f118af9400.png">

* After Signed In 
<img width="680" alt="Screen Shot 2019-05-26 at 10 24 17 PM" src="https://user-images.githubusercontent.com/36215446/58437912-ed7be600-8080-11e9-8031-0842175d9b75.png">

