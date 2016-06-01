package com.example.decode.KECircle;


import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class ForumActivity extends ActionBarActivity {

    private WebView mWebView;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forum);

        Intent intent = getIntent();

        Bundle intentBundle = intent.getExtras();

        final String loggedUser = intentBundle.getString("USERNAME");
       // postData(loggedUser);

        mWebView = (WebView) findViewById(R.id.ForumWebView);

        // Enable Javascript
        WebSettings webSettings = mWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);

        mWebView.loadUrl("http://192.168.43.127/android_connect/forumoptions.php?username="+loggedUser);



    }



    @Override
    public void onBackPressed() {
        if(mWebView.canGoBack()) {
            mWebView.goBack();
        } else {
            super.onBackPressed();
        }
    }

}