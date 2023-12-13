import axios from 'axios';
import { Button } from 'bootstrap';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import swal from 'sweetalert';

function Create(props) {
    const [message, setMessage] = useState('');
    const [bands, setBands] = useState([]);
    const [albums, setAlbums] = useState([]);
    const [bandId, setBandId] = useState('');
    const [albumId, setAlbumId] = useState('');
    const [title, setTitle] = useState('');
    const [body, setBody] = useState('');
    const [errors, setErrors] = useState([]);

    const request = {
        band: bandId,
        album: albumId,
        title,
        body
    }

    const getBands = async () => {
        let response = await axios.get('/bands/table');
        setBands(response.data);
    }

    const getAlbumBySelectedBand = async (e) => {
        setBandId(e.target.value);
        let response = await axios.get(`/albums/get-album-by-${e.target.value}`);
        setAlbums(response.data);
    }

    const store = async (e) => {
        e.preventDefault();
        try{
            let response = await axios.post(props.endpoint, request);
            setMessage(response.data.message);
            setErrors([]);
            setBandId('');
            setAlbumId('');
            setTitle('');
            setBody('');
        }catch(e) {
            setErrors(e.response.data.errors);
        }

        // axios.post(props.endpoint).then((response) => {
        //     console.log(response.data);
        // });
        // console.log(response.data);
    }

    useEffect(() => {
        getBands()
    });
    return (
        <div>
            {message && <div className='alert alert-success' role='alert'>{message}</div>}
            <div className='card'>
                <div className='card-header'>{props.title}</div>
                <div className='card-body'>
                    <form onSubmit={store}>
                        <div className='form-group'>
                            <label htmlFor='band'>Band</label>
                            <select value={bandId} onChange={getAlbumBySelectedBand} name='band' id='name' className='form-control mb-2'>
                                <option value={null}>Choose a band</option>
                                {
                                    bands.map((band) => {
                                        return <option key={band.id} value={band.id}>{band.name}</option>
                                    })
                                }
                            </select>
                            {errors.band ? <div className='text-danger mt-2'>{errors.band[0]}</div> : ''}
                        </div>
                        {
                            albums.length ? 
                            <div className='form-group'>
                            <label htmlFor='album'>Album</label>
                            <select value={albumId} onChange={(e) => setAlbumId(e.target.value)} name='album' id='album' className='form-control mb-2'>
                                <option value={null}>Choose a album</option>
                                {
                                    albums.map((album) => {
                                        return <option key={album.id} value={album.id}>{album.name}</option>
                                    })
                                }
                            </select>
                            {errors.album ? <div className='text-danger mt-2'>{errors.album[0]}</div> : ''}
                        </div> : ''
                        }
                        <div className='form-group'>
                            <label htmlFor='title'>Title</label>
                            <input type='text' value={title} onChange={(e) => setTitle(e.target.value)} name='title' id='title' className='form-control mb-2'/>
                            {errors.title ? <div className='text-danger mt-2'>{errors.title[0]}</div> : ''}
                        </div>

                        <div className='form-group'>
                            <label htmlFor='body'>Lyric</label>
                            <textarea type='text' value={body} onChange={(e) => setBody(e.target.value)} rows={10} name='body' id='body' className='form-control mb-2'/>
                            {errors.body ? <div className='text-danger mt-2'>{errors.body[0]}</div> : ''}
                        </div>
                        
                        <button type='submit' className='btn btn-primary'>Create</button>
                    </form>
                </div>
            </div>
        </div>
    );
}

export default Create;

if (document.getElementById('create-lyric')) {
    let item = document.getElementById('create-lyric');
    ReactDOM.render(<Create title={item.getAttribute('title')} endpoint={item.getAttribute('endpoint')}/>, item);
}
