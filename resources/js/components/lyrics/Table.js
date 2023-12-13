import axios from 'axios';
import { Button } from 'bootstrap';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import swal from 'sweetalert';

function Table(props) {
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
                    <table className='table'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Lyric</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

export default Table;

if (document.getElementById('table-lyric')) {
    let item = document.getElementById('table-lyric');
    ReactDOM.render(<Table title={item.getAttribute('title')} endpoint={item.getAttribute('endpoint')}/>, item);
}
