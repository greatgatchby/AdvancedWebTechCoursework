const Login = () => {
    return(
        <div className={'container d-flex justify-content-center align-items-center min-vh-100'}>
            <div className={'col-md-6'}>
                <div className={'card p-5'}>
                    <form>
                        <div className={'row'}>
                            <div className={'form-group col-3'}>
                                <select className="form-select" aria-label="Default select example">
                                    <option selected value="+44">+44</option>
                                    <option value="+239">+239</option>
                                </select>
                            </div>
                            <div className={'form-group col-9'}>
                                <input className={'form-control'} placeholder={'phone number'}/>
                            </div>
                        </div>
                        <div className={'form-group py-4'}>
                            <input className={'form-control'} type={'password'}  placeholder={'password'}/>
                        </div>
                        <button className={'btn btn-primary'} type={'Submit'}>Login</button>
                    </form>
                    <small className={'py-4'}>Or</small>
                    <a href={'/register'}>Register</a>
                </div>
            </div>
        </div>
    )
}

export default Login
