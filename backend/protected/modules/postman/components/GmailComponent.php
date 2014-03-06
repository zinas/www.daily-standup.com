<?php

/**
 * Component for accessing gmail over imap and reading/parsing the emails
 */
class GmailComponent extends CComponent {
    var $username;
    var $password;
    var $hostname;

    private $_inbox;

    /**
     * Initialize the application component
     * @return null
     */
    public function init() {
        $this->_inbox = imap_open($this->hostname,$this->username,$this->password);

        if ( !$this->_inbox ) {
            throw new Exception(imap_last_error());
        }
    }

    /**
     * Fetch all mails in the inbox, since a specific date
     * @param  int $since ts for the date to search since, defaults to today
     * @return array        all mails in the inbox, with metadata
     */
    public function fetch($since = null) {
        if ( !$since ) $since = time()-300;
        $emails = array();
        $emailIDs = imap_search($this->_inbox,'SINCE "'.date('j F Y', $since).'"');
        if (!$emailIDs) return false;

        rsort($emailIDs);
        foreach ($emailIDs as $emailID) {
            $emails[] = $this->_fetchById($emailID);
        }

        return $emails;
    }

    /**
     * Fetch a mail from the inbox, based on id
     * @param  int $id email id
     * @return array     metadata + parsed text
     */
    private function _fetchById($id) {
        $overview = imap_fetch_overview($this->_inbox,$id,0);
        $message = imap_fetchbody($this->_inbox,$id,1);

        return array(
            'subject'       => $overview[0]->subject,
            'from'          => $overview[0]->from,
            'date'          => $overview[0]->date,
            'in_reply_to'   => $overview[0]->in_reply_to,
            'uid'           => $overview[0]->uid,
            'subject'       => $overview[0]->subject,
            'body'          => EmailReplyParser::parseReply($message)
        );
    }

}