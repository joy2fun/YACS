<?php

/**
 * Check private method name
 *
 * @author Chiao Feng <web@css.js.cn>
 */
class YACS_Sniffs_Method_PrivateMethodNameSniff implements PHP_CodeSniffer_Sniff
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
        $properties = $phpcsFile->getMethodProperties($stackPtr);
        if ($properties['scope'] == 'private') {
            $tokens = $phpcsFile->getTokens();
            $name = $phpcsFile->getDeclarationName($stackPtr);

            if ($tokenNext !== false && $name{0} != '_') {
                $error = "Private method name should start with an underscore(_).";
                $phpcsFile->addError($error, $stackPtr);
            }
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
                T_FUNCTION,
               );
    }

}
