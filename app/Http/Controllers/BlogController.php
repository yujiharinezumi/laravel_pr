<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//ブログクラスを呼び出す
use App\Models\Blog;
use App\Http\Requests\BlogRequest;


class BlogController extends Controller
{
    /**
     * ブログ一覧を表示する
     * @return view
     */
    public function showList()
    {   
        //$blogsの中にブログのデータ全てを入れる
        $blogs = Blog::all();

        // dd($blogs);
        //どのviewを使うのか指定する
        //resources view blogディレクトリにあるlistファイル
        //'blogs'というキーの中にブログの全データ入った$blogsを入れ,viewに渡すことができる
        return view('blog.list',['blogs' => $blogs]);
    }

    /**
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    
    public function showDetail($id)
    {   
        //$blogsの中にブログのデータ全てを入れる
        $blog = Blog::find($id);

        if(is_null($blog)){

            //セッションを使いエラ〜メッセージを表示する
            \Session::flash('err_msg','データがありません');

            //ブログの中身が無い場合、トップ画面にリダイレクトさせる　
            return redirect(route('blogs'));
        }

        
        return view('blog.detail',['blog' => $blog]);
    }

    /**
     * ブログ登録画面を表示する
     * @return view
     */
    
    public function showCreate()
    {   
        return view('blog.form');
    }

    /**
     * ブログを登録する
     * @return view
     */
    
    public function exeStore(BlogRequest $request)
    {   
        // dd($request->all());
        //ブログのデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();

        try {
            //ブログを登録
            Blog::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            //何か不具合があれば500エラーに飛ばす
            // dd($e);
            abort(500);

        }

        \Session::flash('err_msg',' ブログを登録しました');

        //ブログの中身が無い場合、トップ画面にリダイレクトさせる　
        return redirect(route('blogs'));
    }


    /**
     * ブログ編集フォームを表示する
     * @param int $id
     * @return view
     */
    
    public function showEdit($id)
    {   
        //$blogsの中にブログのデータ全てを入れる
        $blog = Blog::find($id);

        if(is_null($blog)){

            //セッションを使いエラ〜メッセージを表示する
            \Session::flash('err_msg','データがありません');

            //ブログの中身が無い場合、トップ画面にリダイレクトさせる　
            return redirect(route('blogs'));
        }

        return view('blog.edit',['blog' => $blog]);
    }


    /**
     * ブログを登録する
     * @return view
     */
    
    public function exeUpdate(BlogRequest $request)
    {   
        //ブログのデータを受け取る
        $inputs = $request->all();

        // dd($inputs);

        \DB::beginTransaction();

        try {
            //ブログを登録
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title'=> $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();

            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            //何か不具合があれば500エラーに飛ばす
            // dd($e);
            abort(500);

        }

        \Session::flash('err_msg',' ブログを更新しました');

        //ブログの中身が無い場合、トップ画面にリダイレクトさせる　
        return redirect(route('blogs'));
    }

    /**
     * ブログ削除　
     * @param int $id
     * @return view
     */
    
    public function exeDelete($id)
    {   
        

        if(empty($id)){
            //セッションを使いエラ〜メッセージを表示する
            \Session::flash('err_msg','データがありません');

            //ブログの中身が無い場合、トップ画面にリダイレクトさせる　
            return redirect(route('blogs'));
        }

        try {
            //ブログを削除
            Blog::destroy($id);
        }catch(\Throwable $e){
            //何か不具合があれば500エラーに飛ばす
            // dd($e);
            abort(500);

        }


        \Session::flash('err_msg','削除しました');

        //ブログの中身が無い場合、トップ画面にリダイレクトさせる　
        return redirect(route('blogs'));
    }

}

