# Encrypt Decrypt Web App
> Using Simple Substitution, Double Transposition, RC4
<p>
<a href="https://github.com/stevenmngo"><img alt="Author" src="https://img.shields.io/badge/author-Stevenmngo-red.svg?style=flat-square"/></a>
</p>

------------------------------
## Introduction 
  
* Simple Substitution
<p>
    Each letter in the plaintext is replaced by a letter some fixed number of positions down the alphabet. For example, with a 
    left shift of 3, D would be replaced by A, E would become B, and so on (wikipedia).
</p>  
* Columnar Transposition 
    In a columnar transposition, the message is written out in rows of a fixed length, and then read out again column by 
    column, and the columns are chosen in some scrambled order. Both the width of the rows and the permutation of the columns 
    are defined by a keyword (wikipedia). 
* RC4
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



