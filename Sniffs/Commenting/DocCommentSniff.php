<?php

/**
 * Check doc comment for classes, methods or functions.
 *
 * @author Chiao Feng <web@css.js.cn>
 */
class YACS_Sniffs_Commenting_DocCommentSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokenLast = $phpcsFile->findPrevious(
                         array(T_DOC_COMMENT_CLOSE_TAG),
                         $stackPtr,
                         max(0, $stackPtr - 10)
                     );

        if ($tokenLast !== false) {
            $tokens = $phpcsFile->getTokens();
            if ($tokens[$stackPtr]['line'] - $tokens[$tokenLast]['line'] > 1) {
                $error = "Doc comment is missing or misformatted.";
                $phpcsFile->addError($error, $stackPtr);
            }
        } else {
            $error = "Doc comment is missing.";
            $phpcsFile->addError($error, $stackPtr);
        }
    }

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return array(
                T_CLASS,
                T_FUNCTION,
               );
    }

}
