 <form method="POST" action="{{ route('login.form')}}">
        @csrf
        <h3>Login Here</h3>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" />

        <button type="submit">Login</button>
    </form>